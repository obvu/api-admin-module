<?php
namespace Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\simple;

use Obvu\Modules\Api\Admin\submodules\crud\components\database\models\crud\element\FullCrudElementObject;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base\BaseFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementHeaderElement;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementListResult;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementSingleResult;
use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Zvinger\BaseClasses\app\exceptions\model\ModelValidateException;

class SimpleFullCrudElementHandler extends BaseFullCrudElementHandler
{
    final public function getList($page = 1, $perPage = 20, $filter = []): FullCrudElementListResult
    {
        $query = $this->getBaseQuery();
        $provider = $this->getDataProvider($query, $page, $perPage);
        $objects = $provider->getModels();
        $result = [];
        foreach ($objects as $object) {
            $result[] = $this->prepareModel($object);
        }

        return \Yii::createObject(
            [
                'class' => FullCrudElementListResult::class,
                'elements' => $result,
                'headers' => $this->prepareHeaders($result),
                'totalCount' => $provider->totalCount,
            ]
        );
    }

    final public function getSingle($id)
    {
        $object = $this->getObjectById($id);

        return \Yii::createObject(
            [
                'class' => FullCrudElementSingleResult::class,
                'element' => $this->prepareModel($object),
            ]
        );
    }

    final public function create($data)
    {
        // TODO: Implement create() method.
        $object = new FullCrudElementObject(
            [
                'module' => $this->module,
                'type' => $this->type,
                'data' => $data,
            ]
        );
        if (!$object->save()) {
            throw new ModelValidateException($object);
        }

        return $this->prepareModel($object);
    }

    final public function update($id, $data, SingleCrudElementModel $fullCrudModel = null)
    {
        $object = $this->getObjectById($id);
        $object->data = $data;
        $object->save();

        return $this->prepareModel($object);
    }

    final public function delete($id)
    {
        FullCrudElementObject::deleteAll(['id' => $id]);
    }

    final private function prepareModel(FullCrudElementObject $elementObject): SingleCrudElementModel
    {
        $result = new SingleCrudElementModel();
        $result->id = $elementObject->id;
        $result->type = $elementObject->type;
        $result->setObject($elementObject);
        $result->fullData = $this->prepareFullData($elementObject);
        $result->listData = $this->prepareListData($elementObject);

        return $result;
    }

    protected function prepareFullData(FullCrudElementObject $elementObject)
    {
        return $elementObject->data ?? new \stdClass();
    }

    protected function prepareListData(FullCrudElementObject $elementObject)
    {
        $data = $elementObject->data;
        $title = isset($data['title']) ? $data['title'] : null;

        return [
            'id' => $elementObject->id,
            'title' => $title,
        ];
    }

    /**
     * @param SingleCrudElementModel[] $elements
     * @return array
     */
    protected function prepareHeaders(array $elements)
    {
        $result = [];
        if (!empty($elements[0])) {
            foreach ($elements[0]->listData as $key => $value) {
                $result[] = \Yii::createObject(
                    [
                        'class' => FullCrudElementHeaderElement::class,
                        'text' => $key,
                        'value' => $key,
                    ]
                );
            }
        }

        return $result;
    }

    /**
     * @return \Obvu\Modules\Api\Admin\submodules\crud\components\database\models\crud\element\FullCrudElementQuery
     */
    private function getBaseQuery()
    {
        return FullCrudElementObject::find()
            ->byType($this->type)
            ->byModule($this->module)
            ->orderBy('sort');
    }

    /**
     * @param $id
     * @return FullCrudElementObject
     * @throws NotFoundHttpException
     */
    private function getObjectById($id)
    {
        if ($id != 0) {
            $object = FullCrudElementObject::findOne($id);
        } else {
            $object = FullCrudElementObject::findOne(
                [
                    'module' => $this->module,
                    'type' => $this->type,
                ]
            );
            if (empty($object)) {
                $object = new FullCrudElementObject(
                    [
                        'type' => $this->type,
                        'module' => $this->module,
                    ]
                );
                $object->save();
            }
        }
        if (empty($object)) {
            throw new NotFoundHttpException();
        }

        return $object;
    }
}
