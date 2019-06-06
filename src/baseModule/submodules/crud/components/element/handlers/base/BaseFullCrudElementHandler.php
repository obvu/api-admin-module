<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementListResult;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementSingleResult;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListFilter;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;

abstract class BaseFullCrudElementHandler extends BaseObject
{
    protected $type;

    protected $module;

    abstract public function getList($page = 1, $perPage = 20, $filter = [], $request = null): FullCrudElementListResult;

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
     * @return FullCrudElementSingleResult
     */
    abstract public function update($id, $data);

    abstract public function delete($id);

    public function buildFilterFromGraphQLArgs($args)
    {
        $filter = new ElementListFilter();
        $conditions = [];
        if ($args['id']) {
            $conditions[] = ['id' => $args['id']];
        }

        if (!empty($conditions)) {
            $filter->conditions = array_merge(['and'], $conditions);
        }
//        d($filter->conditions);die;

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
