<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 14:53
 */

namespace Obvu\Modules\Api\Admin\submodules\content\controllers;


use Obvu\Modules\Api\Admin\submodules\content\components\page\ApiAdminPageRepository;
use Obvu\Modules\Api\Admin\submodules\content\controllers\base\BaseAdminContentController;
use Obvu\Modules\Api\Admin\submodules\content\models\page\request\PageInfoRequest;
use Obvu\Modules\Api\Admin\submodules\content\models\page\response\PageIndexResponse;

class PageController extends BaseAdminContentController
{

    /**
     * @var ApiAdminPageRepository
     */
    private $repository;

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
     *     path="/dwy/content/pages/{pageId}",
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
     *     path="/dwy/content/pages",
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
     *     path="/dwy/content/pages/{pageId}",
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
     *     path="/dwy/content/pages",
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
}