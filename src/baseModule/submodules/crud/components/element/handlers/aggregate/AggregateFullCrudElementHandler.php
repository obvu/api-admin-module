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

class AggregateFullCrudElementHandler extends BaseFullCrudElementHandler
{
    public function getList($page = 1, $perPage = 20, $filter = []): FullCrudElementListResult
    {
        return $this->getConnectedHandler()->getList($page, $perPage, $filter);
    }

    /**
     * @param $id
     * @return FullCrudElementSingleResult
     */
    public function getSingle($id)
    {
        $baseEntity = $this->getConnectedHandler()->getSingle($id);
        $baseEntity->element->type = $this->type;
        $settings = $this->getCurrentModule()->getCrudSettings();
        $entity = $settings->findEntity($this->type);
        foreach ($entity->fields as $field) {
            if ($field instanceof BaseEditDataBlock) {
                $entityKey = $field->entityKey;
                $filter = $this->getSearchFilter($id, $field);
                $baseFullCrudElementHandler = $this->getFullCrudComponent()->defineHandler($entityKey);
                $elementCollection = $baseFullCrudElementHandler->getList(0, 500, $filter);
                foreach ($elementCollection->elements as $item) {
                    $baseEntity->element->subEntity->{$field->name}[] = $item->fullData;
                }
//                d($field);die;
            }
        }

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
        $settings = $this->getCurrentModule()->getCrudSettings();
        $entity = $settings->findEntity($this->type);
        foreach ($fullCrudModel->subEntity as $blockKey => $subEntityElement) {
            $field = $entity->findMultipleBlock($blockKey);
            $filter = $this->getSearchFilter($id, $field);
            $baseFullCrudElementHandler1 = $this->getFullCrudComponent()->defineHandler($field->entityKey);
            $baseFullCrudElementHandler1->deleteByFilter($filter);
            foreach ($subEntityElement as $item) {
                $item['subEntityGroupData'] = $field->name;
                $item[$field->parentElementKey] = $id;
                $baseFullCrudElementHandler1->create($item);
            }
        }

        return $this->getSingle($id);
    }

    private function updateElement($element)
    {
        d($element);
        die;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
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
