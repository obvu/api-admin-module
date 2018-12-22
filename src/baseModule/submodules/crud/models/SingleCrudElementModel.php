<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\models;


class SingleCrudElementModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $type;

    /**
     * @var mixed
     */
    public $listData;

    /**
     * @var mixed
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
}
