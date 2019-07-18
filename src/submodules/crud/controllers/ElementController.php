<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 24.05.18
 * Time: 8:18
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\controllers;


use Obvu\Modules\Api\AdminSubmodules\Crud\components\element\ApiCrudElementComponent;
use yii\rest\OptionsAction;

class ElementController extends BaseCrudController
{
    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function actionOptions()
    {
        return \Yii::createObject(OptionsAction::class)->run();
    }
    /**
     * @SWG\GET(
     *     path="/crud/element/{elementType}/{elementId}",
     *     tags={"crud"},
     *     summary="Получения элемента CRUD",
     *     description="
Общая логика работы с CRUD простая. У каждой сущности CRUD есть type и id.
Type, например, locations. ID = 1. В таком случае вернется модель площадки с идентификатором 1.
Точно такая же логика реализована во всех блоках CRUD. Чтобы получить площадку, нужно сделать запрос к
/dwy/crud/element/locations/1 - аналогино простой работе по REST с locations.
Все остальные методы работают аналогично обычному REST
     ",
     *     @SWG\Parameter(
     *          in="path",
     *          description="Код элемента",
     *          name="elementType",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          in="path",
     *          description="Идентификатор элемента",
     *          name="elementId",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/CrudViewModelResponse")
     *     ),
     * )
     * @param $elementType
     * @param $elementId
     * @return mixed
     * @throws \Exception
     */
    public function actionView($elementType, $elementId)
    {
        return $this->getElementComponent()->viewElement($elementType, $elementId);
    }

    /**
     * @SWG\GET(
     *     path="/crud/element/{elementType}",
     *     tags={"crud"},
     *     summary="Получение списка элементов CRUD",
     *     @SWG\Parameter(
     *          in="path",
     *          description="Код элемента",
     *          name="elementType",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/CrudViewModelResponse")
     *     ),
     * )
     * @param $elementType
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex($elementType)
    {
        return $this->getElementComponent()->listElement($elementType);
    }

    /**
     * @SWG\Put(
     *     path="/crud/element/{elementType}/{elementId}",
     *     tags={"crud"},
     *     summary="Обновление элемента CRUD",
     *     @SWG\Parameter(
     *          in="path",
     *          description="Код элемента",
     *          name="elementType",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          in="path",
     *          description="Идентификатор элемента",
     *          name="elementId",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/CrudViewModelResponse")
     *     ),
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/CrudElementDataRequest")
     *     ),
     * )
     * @param $elementType
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    /**
     * @param $elementType
     * @param $elementId
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($elementType, $elementId)
    {
        return $this->getElementComponent()->updateElement($elementType, $elementId, \Yii::$app->request->post('data'));
    }

    /**
     * @SWG\Post(
     *     path="/crud/element/{elementType}",
     *     tags={"crud"},
     *     summary="Создание элемента CRUD",
     *     @SWG\Parameter(
     *          in="path",
     *          description="Код элемента",
     *          name="elementType",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/CrudViewModelResponse")
     *     ),
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/CrudElementDataRequest")
     *     ),
     * )
     * @param $elementType
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    /**
     * @param $elementType
     * @param $elementId
     * @return mixed
     * @throws \Exception
     */
    public function actionCreate($elementType)
    {
        return $this->getElementComponent()->createElement($elementType, \Yii::$app->request->post('data'));
    }


    /**
     * @return ApiCrudElementComponent
     */
    private function getElementComponent()
    {
        return $this->module->apiElement;
    }
}