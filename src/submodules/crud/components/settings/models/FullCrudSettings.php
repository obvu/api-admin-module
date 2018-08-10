<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 10.08.18
 * Time: 9:59
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models;

/**
 * Class FullCrudSettings
 * @package Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models
 * @SWG\Definition()
 */
class FullCrudSettings
{
    /**
     * @var SingleSettingsModel[]
     * @SWG\Property()
     */
    public $fields;
}