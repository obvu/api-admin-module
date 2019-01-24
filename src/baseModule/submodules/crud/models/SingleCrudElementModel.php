<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\models;

/**
 * Class SingleCrudElementModel
 * @package Obvu\Modules\Api\Admin\submodules\crud\models
 * @SWG\Definition()
 */
class SingleCrudElementModel
{
    /**
     * @var int
     * @SWG\Property()
     */
    public $id;

    /**
     * @var string
     * @SWG\Property()
     */
    public $type;

    /**
     * @var object
     * @SWG\Property()
     */
    public $listData;

    /**
     * @var object
     * @SWG\Property()
     */
    public $fullData;

    private $_object;

    /**
     * @param mixed $object
     */
    public function setObject($object): void
    {
        $this->_object = $object;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->_object;
    }
}
