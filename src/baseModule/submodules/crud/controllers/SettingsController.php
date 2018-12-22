<?php

namespace Obvu\Modules\Api\Admin\submodules\crud\controllers;

class SettingsController extends BaseFullCrudController
{
    public function actionIndex()
    {
        $crudSettings = $this->module->crudSettings;
        $crudSettings = \Yii::createObject($crudSettings);

        return $crudSettings;
    }
}
