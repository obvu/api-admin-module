<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 28.05.18
 * Time: 23:56
 */

namespace ObvuCrudModule\components\settings\models;

/**
 * Class SettingsFormModel
 * @package ObvuCrudModule\components\settings\models
 * @SWG\Definition()
 */
class SettingsFormModel
{
    /**
     * @var SingleSettingsFormField[]
     * @SWG\Property()
     */
    public $fields;
}