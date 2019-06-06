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

    /**
     * @var object
     * @SWG\Property()
     */
    public $rawData = [];

    /**
     * @var array
     */
    public $elementMiscData = [];

    /**
     * @var object| callable
     * @SWG\Property()
     */
    public $subEntity;

    public $formattedMiscData = [];

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

    public function __construct()
    {
        $this->subEntity = new \stdClass();
    }

    public function prepareSubEntity($inside = false)
    {
        if (is_callable($this->subEntity)) {
            $this->subEntity = ($this->subEntity)();
        }
        if ($inside) {
            $this->subEntity = (array)$this->subEntity;
            foreach ($this->subEntity as $key => $item) {
                if (is_callable($item)) {
                    $this->subEntity[$key] = ($item)();
                }
            }
        }

        return $this;
    }

    public function pushMiscData($key, $value)
    {
        $el = [
            'key' => $key,
            'value' => $value,
        ];
        $set = false;
        foreach ($this->elementMiscData as &$elementMiscDatum) {
            if ($elementMiscDatum['key'] === $key) {
                $elementMiscDatum = $el;
                $set = true;
            }
        }
        if (!$set) {
            $this->elementMiscData[] = [
                'key' => $key,
                'value' => $value,
            ];
        }
        $this->formattedMiscData[$key] = $value;
    }
}
