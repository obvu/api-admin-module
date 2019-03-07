<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 11:03
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema;


use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\crud\CrudFieldFileType;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\CrudBlockType;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\CrudElementType;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\CrudFullDataType;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\CrudSubEntityDataType;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\input\CrudFullDataInputData;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\input\CrudSortInputData;

class Types
{
    private static $query;
    private static $mutation;

    private static $crudElement;
    private static $crudBlock;
    private static $crudFullData;

    private static $fields  = [];

    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function crudElement()
    {
        return self::$crudElement ?: (self::$crudElement = new CrudElementType());
    }

    public static function crudBlock($type)
    {
        return self::$crudBlock[$type] ?: (self::$crudBlock[$type] = new CrudBlockType($type));
    }

    public static function crudFullData($type)
    {
        return self::$crudFullData[$type] ?: (self::$crudFullData[$type] = new CrudFullDataType($type));
    }

    public static function crudSubEntityData($type)
    {
        return static::getField('subEntity'.$type, CrudSubEntityDataType::class, $type);
    }

    public static function inputFullData($type)
    {
        return static::getField('inputFullData'.$type, CrudFullDataInputData::class, $type);
    }

    public static function sortData($type)
    {
        return static::getField('sortData'.$type, CrudSortInputData::class, $type);
    }

    public static function file()
    {
        return static::getField('file', CrudFieldFileType::class);
    }

    private static function getField($type, $class, $constructVar = null)
    {
        return self::$fields[$type] ?: (self::$fields[$type] = new $class($constructVar));
    }
}
