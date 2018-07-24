<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 29.05.18
 * Time: 0:01
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models;

/**
 * Class SingleSettingsFormField
 * @package ObvuCrudModule\components\settings\models
 * @SWG\Definition()
 */
class SingleSettingsFormField
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
    public $name;

    /**
     * @var string
     * @SWG\Property()
     */
    public $type;

    /**
     * @var string
     * @SWG\Property()
     */
    public $label;

    /**
     * @var object
     * @SWG\Property()
     */
    public $config;
}