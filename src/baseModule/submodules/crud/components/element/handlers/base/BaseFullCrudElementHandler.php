<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementListResult;

abstract class BaseFullCrudElementHandler
{
    protected $type;

    protected $module;

    abstract public function getList($page = 1, $perPage = 20, $filter = []): FullCrudElementListResult;

    abstract public function getSingle($id);

    abstract public function create($data);

    abstract public function update($id, $data);

    abstract public function delete($id);

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module): void
    {
        $this->module = $module;
    }
}
