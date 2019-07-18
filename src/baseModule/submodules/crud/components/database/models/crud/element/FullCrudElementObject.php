<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\database\models\crud\element;


class FullCrudElementObject extends DBFullCrudElementObject
{
    /**
     * @return FullCrudElementQuery
     */
    public static function find()
    {
        return new FullCrudElementQuery(get_called_class());
    }
}
