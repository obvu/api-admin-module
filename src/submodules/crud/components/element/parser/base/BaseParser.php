<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 24.05.18
 * Time: 12:32
 */

namespace ObvuCrudModule\components\element\parser\base;


use ObvuCrudModule\components\database\models\crud\element\CrudElementObject;
use ObvuCrudModule\models\view\response\CrudViewModelResponse;

abstract class BaseParser
{
    /**
     * @param CrudElementObject $object
     * @return mixed
     */
    public function parseObject(CrudElementObject $object)
    {
        return $object->getDataObject() ?: new \stdClass();
    }

    public function parseTitle(CrudElementObject $object): string
    {
        $dataObject = $object->getDataObject();
        if (!empty($dataObject->title)) {
            return $dataObject->title;
        }

        return "";
    }
}