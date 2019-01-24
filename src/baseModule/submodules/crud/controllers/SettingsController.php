<?php

namespace Obvu\Modules\Api\Admin\submodules\crud\controllers;

class SettingsController extends BaseFullCrudController
{
    /**
     * @SWG\Post(path="/settings/index",
     *     tags={"element"},
     *     summary="Сохранение конкретного элемента",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/ElementSingleResponse")
     *     ),
     * )
     */
    public function actionIndex()
    {
        $this->module->getElementComponent()->setFormat(false);
        $crudSettings = $this->module->crudSettings;
        $crudSettings = \Yii::createObject($crudSettings);

        return $crudSettings;
    }
}
