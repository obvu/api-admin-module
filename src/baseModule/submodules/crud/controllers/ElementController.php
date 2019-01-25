<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\controllers;


use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListRequest;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\single\ElementSingleRequest;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\single\ElementSingleResponse;

class ElementController extends BaseFullCrudController
{
    /**
     * @SWG\Post(path="/element/index",
     *     tags={"element"},
     *     summary="Получение списка элементов",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/ElementListRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/ElementListResponse")
     *     ),
     * )
     */
    public function actionIndex()
    {
        $request = ElementListRequest::createRequest();

        $fullCrudElementComponent = $this->module->getElementComponent();
        $elementListResponse = $fullCrudElementComponent->setFormat(false)->listElement($request);
        $elementListResponse->headers = $fullCrudElementComponent->getHeaders($request);
        return $fullCrudElementComponent->prepareListData($elementListResponse, $request);
    }

    /**
     * @SWG\Post(path="/element/single",
     *     tags={"element"},
     *     summary="Получение конкретного элемента",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/ElementSingleRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/ElementSingleResponse")
     *     ),
     * )
     */
    public function actionSingle()
    {
        $request = ElementSingleRequest::createRequest();
        return $this->module->getElementComponent()->setFormat(true)->singleElement($request);
    }

    /**
     * @SWG\Post(path="/element/update",
     *     tags={"element"},
     *     summary="Сохранение конкретного элемента",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/ElementSingleResponse")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/ElementSingleResponse")
     *     ),
     * )
     */
    public function actionUpdate()
    {
        $request = ElementSingleResponse::createRequest();

        return $this->module->getElementComponent()->updateElement($request);
    }

    /**
     * @SWG\Post(path="/element/create",
     *     tags={"element"},
     *     summary="Создание элемента",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/ElementSingleResponse")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/ElementSingleResponse")
     *     ),
     * )
     */
    public function actionCreate()
    {
        $request = ElementSingleResponse::createRequest();

        return $this->module->getElementComponent()->createElement($request);
    }

    /**
     * @SWG\Post(path="/element/delete",
     *     tags={"element"},
     *     summary="Удаление элемента",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/ElementSingleResponse")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/ElementSingleResponse")
     *     ),
     * )
     */
    public function actionDelete()
    {
        $request = ElementSingleResponse::createRequest();

        return $this->module->getElementComponent()->deleteElement($request);
    }
}
