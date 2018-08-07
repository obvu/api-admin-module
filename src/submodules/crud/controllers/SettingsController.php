<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 28.05.18
 * Time: 23:43
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\controllers;


class SettingsController extends BaseCrudController
{
    /**
     * @SWG\GET(
     *     path="/crud/settings",
     *     tags={"crud"},
     *     summary="Получение списка элементов CRUD",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/SingleSettingsModel")
     *     ),
     * )
     * @param $elementType
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    /**
     * @return
     */
    public function actionIndex(): array
    {
        return $this->module->crudSettings;
    }
}