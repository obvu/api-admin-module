<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\simple;


use Obvu\Modules\Api\Admin\submodules\crud\components\database\models\crud\element\FullCrudElementObject;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base\BaseFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementHeaderElement;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementListResult;
use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;
use yii\data\ActiveDataProvider;

class SimpleFullCrudElementHandler extends BaseFullCrudElementHandler
{
    final public function getList($page = 1, $perPage = 20, $filter = []): FullCrudElementListResult
    {
        $query = $this->getBaseQuery();
        $provider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
        $provider->pagination->setPage($page - 1);
        $provider->pagination->pageSize = $perPage;
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
        // TODO: Implement getSingle() method.
    }

    final public function create($data)
    {
        // TODO: Implement create() method.
    }

    final public function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    final public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    final private function prepareModel(FullCrudElementObject $elementObject): SingleCrudElementModel
    {
        $result = new SingleCrudElementModel();
        $result->id = $elementObject->id;
        $result->type = $this->type;
        $result->setObject($elementObject);
        $result->fullData = $this->prepareFullData($elementObject);
        $result->listData = $this->prepareListData($elementObject);

        return $result;
    }

    protected function prepareFullData(FullCrudElementObject $elementObject)
    {
        return $elementObject->data;
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
            ->orderBy('sort, cast(data_id as unsigned)');
    }
}
