<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\FullCrudElementComponent;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementListResult;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementSingleResult;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\CrudSingleEntity;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListFilter;
use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

abstract class BaseFullCrudElementHandler extends BaseObject
{
    protected $type;

    protected $module;

    /**
     * @var CrudSingleEntity
     */
    private $entity;

    /**
     * @var FullCrudElementComponent
     */
    private $fullCrudComponent;

    abstract public function getList($page = 1, $perPage = 20, $filter = []): FullCrudElementListResult;

    /**
     * @param $id
     * @return FullCrudElementSingleResult
     */
    abstract public function getSingle($id);

    /**
     * @param $data
     * @return FullCrudElementSingleResult
     */
    abstract public function create($data);

    /**
     * @param $id
     * @param $data
     * @param SingleCrudElementModel|null $fullCrudModel
     * @return FullCrudElementSingleResult
     */
    abstract public function update($id, $data, SingleCrudElementModel $fullCrudModel = null);

    abstract public function delete($id);

    public function deleteByIds($ids = [])
    {
        $count = 0;
        foreach ($ids as $id) {
            $this->delete($id);
            $count++;
        }

        return $count;
    }

    public function deleteByFilter($filter)
    {
        $list = $this->getList(1, 300, $filter);
        $ids = ArrayHelper::getColumn(ArrayHelper::getValue($list, 'elements'), 'id');

        return $this->deleteByIds($ids);
    }

    public function buildFilterFromGraphQLArgs($args)
    {
        $filter = new ElementListFilter();
        $conditions = [];
        if ($args['id']) {
            $conditions[] = ['id' => $args['id']];
        }
        if ($args['fullData']) {
            foreach ($args['fullData'] as $key => $value) {
                $arr = [$key => $value];
                if (is_numeric($value)) {
                    $arr = ['or', $arr, [$key => floatval($value)]];
                }
                $conditions[] = $arr;
            }
        }
        if (!empty($args['sortData'])) {
            $resultOrderBy = [];
            foreach ($args['sortData'] as $key => $sortDatum) {
                if ($sortDatum == 'asc') {
                    $resultOrderBy[$key] = SORT_ASC;
                } elseif ($sortDatum == 'desc') {
                    $resultOrderBy[$key] = SORT_DESC;
                }
            }
        }
        if (!empty($conditions)) {
            $filter->conditions = array_merge(['and'], $conditions);
//            if (empty($filter->conditions[2])) {
//                $filter->conditions[2] = '1=1';
//            }
        }

        return $filter;
    }

    /**
     * @param mixed $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module): void
    {
        $this->module = $module;
    }

    /**
     * @return FullCrudModule
     */
    public function getCurrentModule()
    {
        return \Yii::$app->getModule($this->module);
    }

    /**
     * @param CrudSingleEntity $entity
     */
    public function setEntity(CrudSingleEntity $entity): void
    {
        $this->entity = $entity;
    }

    /**
     * @return CrudSingleEntity
     */
    public function getEntity(): CrudSingleEntity
    {
        return $this->entity;
    }

    /**
     * @return FullCrudElementComponent
     */
    public function getFullCrudComponent(): FullCrudElementComponent
    {
        return $this->fullCrudComponent;
    }

    /**
     * @param FullCrudElementComponent $fullCrudComponent
     */
    public function setFullCrudComponent(FullCrudElementComponent $fullCrudComponent): void
    {
        $this->fullCrudComponent = $fullCrudComponent;
    }

    protected function getDataProvider($query, $page = 1, $perPage = 20)
    {
        $provider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
        if (!$page) {
            $provider->pagination->setPage(null);
            $provider->pagination->pageSize = 0;
        } else {
            $provider->pagination->setPage($page - 1);
            $provider->pagination->pageSize = $perPage;
        }

        return $provider;
    }


}
