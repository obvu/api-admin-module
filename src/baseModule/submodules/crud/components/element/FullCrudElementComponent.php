<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\element;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\aggregate\AggregateFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base\BaseFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementSingleResult;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\simple\SimpleFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\FullCrudSettings;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListFilter;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListRequest;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListResponse;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\single\ElementSingleRequest;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\single\ElementSingleResponse;
use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

class FullCrudElementComponent
{
    public $handlers = [];

    public $defaultHandlerClass = SimpleFullCrudElementHandler::class;

    /**
     * @var FullCrudModule
     */
    public $module;

    private $format = false;

    private $deepLoad = true;

    private $_list_cache = [];

    /**
     * @var FullCrudSettings
     */

    public function listElement(ElementListRequest $request)
    {
        $key = md5('list'.Json::encode($request));
        if ($this->_list_cache[$key]) {
            return $this->_list_cache[$key];
        }
        if (!$request->filter) {
            $request->filter = new ElementListFilter();
        }
        if ($request->sortBy) {
            $request->filter->orderBy = $request->sortBy;
        }
        $result = $this->defineHandler($request->type)->getList($request->page, $request->perPage, $request->filter);

        if ($this->format) {
            $context = $this;
            $result->elements = array_map(
                function (SingleCrudElementModel $el) use ($context) {
                    $el = $this->prepareFullData($el);

                    return $el;
                },
                $result->elements
            );
        }

        $this->_list_cache[$key] = \Yii::createObject(
            [
                'class' => ElementListResponse::class,
                'elements' => $result->elements,
                'totalCount' => $result->totalCount,
                'headers' => $result->headers,
            ]
        );

        return $this->_list_cache[$key];
    }

    public function getHeaders(ElementListRequest $request)
    {
        /** @var FullCrudModule $module */
        $module = $this->getCurrentModule();
        $crudSettings = $module->getCrudSettings();
        $block = $crudSettings->findBlock($request->type);
        $entity = $crudSettings->findEntity($request->type);
        $fieldNames = [];
        foreach ((array)$block->tableFields as $tableField) {
            $fieldSettings = $entity->findField($tableField);
            $fieldNames[] = [
                'text' => $fieldSettings->label,
                'value' => $tableField,
            ];
        }

        return $fieldNames;
    }

    /**
     * @param SingleCrudElementModel $singleCrudElementModel
     * @return mixedЫ
     */
    public function prepareFullData(&$singleCrudElementModel = null)
    {
        /** @var FullCrudModule $module */
        if (!$singleCrudElementModel) {
            return $singleCrudElementModel;
        }
        $module = $this->getCurrentModule();
        $crudSettings = $module->getCrudSettings();
        $entity = $crudSettings->findEntity($singleCrudElementModel->type);
        foreach ($entity->fields as $field) {
            if (strpos($field->name, '.') !== false) {
                $array = explode('.', $field->name);
                $object = $singleCrudElementModel->getObject();
                $var = $object->{$array[0]};
                $singleCrudElementModel->fullData[$field->name] = $var->{$array[1]};
                unset($singleCrudElementModel->fullData[$array[0]][$array[1]]);
            }
            if ($field->defaultValue) {
                $singleCrudElementModel->fullData[$field->name] = $field->defaultValue;
            } elseif ($field->type === $field::TYPE_SELECT) {
                if (!$singleCrudElementModel->fullData[$field->name]) {
                    $singleCrudElementModel->fullData[$field->name] = $field->variants[0]->key;
                }
            }
        }
        foreach ((array)$entity->rawData as $rawDatum) {
            $singleCrudElementModel->rawData[] = $rawDatum
                ->setEntity($singleCrudElementModel)
                ->getData();
        }

        return $singleCrudElementModel;
    }

    public function prepareListData(ElementListResponse $response, ElementListRequest $request)
    {
        /** @var FullCrudModule $module */
        $module = $this->getCurrentModule();
        $crudSettings = $module->getCrudSettings();
        $entity = $crudSettings->findEntity($request->type);
        if ($entity->aggregateEntity) {
            $entity = $crudSettings->findEntity($entity->aggregateEntity);
        }
        foreach ($response->elements as $element) {
            $resultListData = [];
            foreach ($entity->fields as $field) {
                if ($field->type === $field::TYPE_INPUT_TEXT) {
                    if ($element->fullData[$field->name]) {
                        $resultListData[$field->name] = $element->fullData[$field->name];
                    }
                } elseif ($field->type === $field::TYPE_SELECT) {
                    $variants = $field->variants;
                    foreach ($variants as $variant) {
                        if ($variant->key === $element->fullData[$field->name]) {
                            $resultListData[$field->name] = $variant->value;
                        }
                    }
                }
            }
            $element->listData = $resultListData;
        }

        return $response;
    }

    public function singleElement(ElementSingleRequest $request)
    {
        try {
            $data = $this->defineHandler($request->type)->getSingle($request->id);
        } catch (NotFoundHttpException $e) {
            if ($request->id == 0) {
                $id = $this->defineHandler($request->type)->getList()->elements[0]->id;
                if (empty($id)) {
                    $data = $this->defineHandler($request->type)->create([])->element;
                } else {
                    $data = $this->defineHandler($request->type)->getSingle($id);
                }
            } else {
                throw $e;
            }
        }
        if ($this->format) {
            $data->element = $this->prepareFullData($data->element);
        }

        return $data;

    }

    public function updateElement(ElementSingleResponse $request)
    {
        $fullCrudElementSingleResult = $this->defineHandler($request->element->type)->update(
            $request->element->id,
            $request->element->fullData,
            $request->element
        );

        if ($this->format) {
            $fullCrudElementSingleResult->element = $this->prepareFullData(
                $fullCrudElementSingleResult->element
            );
        }

        return $fullCrudElementSingleResult;
    }

    public function createElement(ElementSingleResponse $request)
    {
        $fullCrudElementSingleResult = $this->defineHandler($request->element->type)->create(
            $request->element->fullData
        );

        if ($this->format) {
            $request->element = $this->prepareFullData(
                $fullCrudElementSingleResult->element
            );
        }

        return $request;
    }

    public function deleteElement(ElementSingleResponse $request)
    {
        return $this->defineHandler($request->element->type)->delete($request->element->id);
    }

    public function buildFilterFromGraphQLArgs($type, $args = [])
    {
        return $this->defineHandler($type)->buildFilterFromGraphQLArgs($args);
    }

    public function defineHandler($type)
    {
        $settings = $this->getCurrentModule()->getCrudSettings();
        $entity = $settings->findEntity($type);
        if ($entity->aggregateEntity) {
            $handlerClass = AggregateFullCrudElementHandler::class;
        } else {
            $handlerClass = !empty($this->handlers[$type]) ? $this->handlers[$type] : $this->defaultHandlerClass;
        }

        /** @var BaseFullCrudElementHandler $handler */
        $handler = \Yii::createObject($handlerClass);
        $handler->setType($type);
        $handler->setModule($this->module);
        $handler->setEntity($entity);
        $handler->setFullCrudComponent($this);

        return $handler;
    }

    /**
     * @param bool $format
     * @return FullCrudElementComponent
     */
    public function setFormat(bool $format): FullCrudElementComponent
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFormat(): bool
    {
        return $this->format;
    }

    /**
     * @param bool $deepLoad
     */
    public function setDeepLoad(bool $deepLoad): void
    {
        $this->deepLoad = $deepLoad;
    }

    /**
     * @return bool
     */
    public function isDeepLoad(): bool
    {
        return $this->deepLoad;
    }

    /**
     * @return FullCrudModule
     */
    private function getCurrentModule()
    {
        return \Yii::$app->getModule($this->module);
    }
}
