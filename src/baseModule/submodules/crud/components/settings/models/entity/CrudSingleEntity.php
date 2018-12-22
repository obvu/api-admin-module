<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity;


use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\CrudSingleField;
use yii\base\BaseObject;

/**
 * Class CrudSingleEntity
 * @package Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity
 * @SWG\Definition()
 */
class CrudSingleEntity extends BaseObject
{
    /**
     * @var string
     * @SWG\Property()
     */
    public $title;

    /**
     * @var string
     * @SWG\Property()
     */
    public $key;

    /**
     * @var CrudSingleField[]
     * @SWG\Property()
     */
    public $fields;
}
