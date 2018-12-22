<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\controllers;


use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListRequest;

class ElementController extends BaseFullCrudController
{
    /**
     * @SWG\Post(path="/element/index",
     *     tags={"corpinn"},
     *     summary="Отправка заявки",
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

        return $this->module->getElementComponent()->listElement($request);
    }
}
