<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 14:53
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\controllers;


use Obvu\Modules\Api\AdminSubmodules\Content\components\page\ApiAdminPageRepository;
use Obvu\Modules\Api\AdminSubmodules\Content\controllers\base\BaseAdminContentController;
use Obvu\Modules\Api\AdminSubmodules\Content\models\page\request\PageInfoRequest;
use Obvu\Modules\Api\AdminSubmodules\Content\models\page\response\PageIndexResponse;

class PageController extends BaseAdminContentController
{

    /**
     * @var ApiAdminPageRepository
     */
    private $repository;

    /**
     * PageController constructor.
     * @param string $id
     * @param $module
     * @param ApiAdminPageRepository $repository
     * @param array $config
     */
    public function __construct(
        string $id,
        $module,
        ApiAdminPageRepository $repository,
        array $config = [])
    {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
    }

    /**
     * @SWG\Get(
     *     path="/content/pages/{pageId}",
     *     tags={"Page"},
     *     summary="Получение страницы",
     *     @SWG\Parameter(
     *          in="path",
     *          description="Идентификатор страницы",
     *          name="pageId",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/PageModel")
     *     ),
     * )
     */
    public function actionView($id)
    {
        return $this->repository->getModel($id);
    }

    /**
     * @SWG\Post(
     *     path="/content/pages",
     *     tags={"Page"},
     *     summary="Создание страницы",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/PageInfoRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/PageModel")
     *     ),
     * )
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionCreate()
    {
        return $this->repository->createModel(PageInfoRequest::createRequest());
    }

    /**
     * @SWG\Put(
     *     path="/content/pages/{pageId}",
     *     tags={"Page"},
     *     summary="Редактирование страницы",
     *     @SWG\Parameter(
     *          in="path",
     *          description="Идентификатор страницы",
     *          name="pageId",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/PageInfoRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/PageModel")
     *     ),
     * )
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionUpdate($id)
    {
        return $this->repository->updateModel($id, PageInfoRequest::createRequest());
    }


    /**
     * @SWG\GET(
     *     path="/content/pages",
     *     tags={"Page"},
     *     summary="Получение списка текстовых блоков",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Текстовые блокиы",
     *         @SWG\Schema(ref = "#/definitions/PageIndexResponse")
     *     ),
     * )
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $response = \Yii::createObject([
            'class'    => PageIndexResponse::class,
            'elements' => $this->repository->getModelsList(),
        ]);

        return $response;
    }

    /**
     * @SWG\DELETE(path="/content/page/{postId}",
     *     tags={"blog"},
     *     summary="Создание страницы",
     *     @SWG\Parameter(
     *          in="path",
     *          name="pageId",
     *          type="integer",
     *          required=true
     *     )
     * )
     * @param $id
     * @return boolean
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionDelete($id)
    {
        return $this->repository->deleteElement($id);
    }
}
