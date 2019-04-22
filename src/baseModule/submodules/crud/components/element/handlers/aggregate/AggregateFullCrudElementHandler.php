<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 15.02.2019
 * Time: 15:37
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\aggregate;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base\BaseFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementListResult;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementSingleResult;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\base\BaseEditDataBlock;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\multipleBlock\MultipleEditDataBlock;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListFilter;
use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;
use yii\helpers\ArrayHelper;

class AggregateFullCrudElementHandler extends BaseFullCrudElementHandler
{
    public function getList($page = 1, $perPage = 20, $filter = []): FullCrudElementListResult
    {
        $fullCrudElementListResult = $this->getConnectedHandler()->getList($page, $perPage, $filter);
        $ids = ArrayHelper::getColumn($fullCrudElementListResult->elements, 'id');
        $fullCrudElementListResult->elements = [];
        foreach ($ids as $id) {
            $fullCrudElementListResult->elements[] = $this->getSingle($id)->element;
        }

        return $fullCrudElementListResult;
    }

    /**
     * @param $id
     * @return FullCrudElementSingleResult
     */
    public function getSingle($id)
    {
        $baseEntity = $this->getConnectedHandler()->getSingle($id);
        $id = $baseEntity->element->fullData['__entityId'] ?? $id;
        $baseEntity->element->type = $this->type;
        $baseEntity->element->subEntity = function ($subEntityFilters = null) use ($id) {
            $subEntity = new \stdClass();
            $settings = $this->getCurrentModule()->getCrudSettings();
            $entity = $settings->findEntity($this->type);
            foreach ((array)$entity->fields as $field) {
                if ($field instanceof BaseEditDataBlock) {
                    $subEntity->{$field->name} = function ($fieldFilters = null) use ($field, $id) {
                        $var = [];
                        $entityKey = $field->entityKey;
                        $filter = $this->getSearchFilter($id, $field);
                        $gqlFilters = $this->buildFilterFromGraphQLArgs($fieldFilters, $entityKey);
                        if ($gqlFilters->conditions) {
                            $filter->conditions[] = $gqlFilters->conditions;
                        }
                        if ($gqlFilters->orderBy) {
                            $filter->orderBy = array_merge((array)$filter->orderBy, (array)$gqlFilters->orderBy);
                        }
                        $baseFullCrudElementHandler = $this->getFullCrudComponent()->defineHandler($entityKey);
                        $elementCollection = $baseFullCrudElementHandler->getList(0, 500, $filter);
                        foreach ($elementCollection->elements as $item) {
                            $var[] = $item;
                        }

                        return $var;
                    };
                }
            }

            return $subEntity;
        };

        return $baseEntity;
    }

    /**
     * @param $data
     * @return FullCrudElementSingleResult
     */
    public function create($data)
    {
        $result = $this->getConnectedHandler()->create($data);

        return $this->getSingle($result->element->id);
    }

    /**
     * @param $id
     * @param $data
     * @param SingleCrudElementModel|null $fullCrudModel
     * @return void
     */
    public function update($id, $data, SingleCrudElementModel $fullCrudModel = null)
    {
        $baseFullCrudElementHandler = $this->getConnectedHandler();
        $baseFullCrudElementHandler->update($id, $data, $fullCrudModel);
        $entityId = $data['__entityId'] ?? $id;
        $data['__entityId'] = $entityId;
        $settings = $this->getCurrentModule()->getCrudSettings();
        $entity = $settings->findEntity($this->type);
        foreach ($fullCrudModel->subEntity as $blockKey => $subEntityElement) {
            $field = $entity->findMultipleBlock($blockKey);
            $filter = $this->getSearchFilter($entityId, $field);
            $baseFullCrudElementHandler1 = $this->getFullCrudComponent()->defineHandler($field->entityKey);
            $baseFullCrudElementHandler1->deleteByFilter($filter);
            foreach ($subEntityElement as $item) {
                $item['fullData']['subEntityGroupData'] = $field->name;
                $item['fullData'][$field->parentElementKey] = $entityId;
                $baseFullCrudElementHandler1->create($item['fullData']);
            }
        }

        return $this->getSingle($id);
    }

    public function delete($id)
    {
        $baseFullCrudElementHandler = $this->getConnectedHandler();
        $baseFullCrudElementHandler->delete($id);
    }

    private function getConnectedHandler()
    {
        return $this->getFullCrudComponent()->defineHandler($this->getEntity()->aggregateEntity);
    }

    /**
     * @param $id
     * @param $field
     * @return object|ElementListFilter
     * @throws \yii\base\InvalidConfigException
     */
    private function getSearchFilter($id, BaseEditDataBlock $field): ElementListFilter
    {
        $filter = \Yii::createObject(
            [
                'class' => ElementListFilter::class,
            ]
        );
        $filter->conditions = ['and', [$field->parentElementKey => $id]];
        if (!$field->notGroup) {
            $filter->conditions[] = ['subEntityGroupData' => $field->name];
        }

        return $filter;
    }
}
