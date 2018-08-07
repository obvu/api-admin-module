<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 28.05.18
 * Time: 23:44
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\components\settings;


use Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models\SettingsFormModel;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models\SingleSettingsFormField;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models\SingleSettingsModel;

class CrudSettingsRepository
{
    public $crudSettings = [];
    /**
     * @return SingleSettingsModel[]
     * @throws \yii\base\InvalidConfigException
     */
    public function getSettings()
    {
        return $this->crudSettings;
    }
}