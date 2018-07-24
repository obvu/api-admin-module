<?php

namespace ObvuCrudModule\components\settings\models;

/**
 * Class SingleSettingsModel
 * @package ObvuCrudModule\components\settings\models
 * @SWG\Definition()
 */
class SingleSettingsModel
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
     * @var SettingsFormModel
     * @SWG\Property()
     */
    public $form;
}