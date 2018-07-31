<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 14:53
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\controllers;


use Obvu\Modules\Api\AdminSubmodules\Content\components\textBlock\AdminTextBlockRepository;
use Obvu\Modules\Api\AdminSubmodules\Content\controllers\base\BaseAdminContentController;
use Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\request\TextBlockInfoRequest;
use Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\response\TextBlockIndexResponse;

class TextBlockController extends BaseAdminContentController
{

    /**
     * @var AdminTextBlockRepository
     */
    private $repository;

    /**
     * TextBlockController constructor.
     * @param string $id
     * @param $module
     * @param AdminTextBlockRepository $repository
     * @param array $config
     */
    public function __construct(
        string $id,
        $module,
        AdminTextBlockRepository $repository,
        array $config = [])
    {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
    }

    /**
     * @SWG\GET(
     *     path="/content/text-blocks/{textBlockId}",
     *     tags={"Text Block"},
     *     summary="Получение текстового блока",
     *     @SWG\Parameter(
     *          in="path",
     *          description="Идентификатор текстового блока",
     *          name="textBlockId",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/TextBlockModel")
     *     ),
     * )
     */
    public function actionView($id)
    {
        return $this->repository->getModel($id);
    }

    /**
     * @SWG\Post(
     *     path="/content/text-blocks",
     *     tags={"Text Block"},
     *     summary="Создание текстового блока",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/TextBlockInfoRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/TextBlockModel")
     *     ),
     * )
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionCreate()
    {
        return $this->repository->createModel(TextBlockInfoRequest::createRequest());
    }

    /**
     * @SWG\PUT(
     *     path="/content/text-blocks/{textBlockId}",
     *     tags={"Text Block"},
     *     summary="Редактирование текстового блока",
     *     @SWG\Parameter(
     *          in="path",
     *          description="Идентификатор текстового блока",
     *          name="textBlockId",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/TextBlockInfoRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/TextBlockModel")
     *     ),
     * )
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionUpdate($id)
    {
        return $this->repository->updateModel($id, TextBlockInfoRequest::createRequest());
    }


    /**
     * @SWG\GET(
     *     path="/content/text-blocks",
     *     tags={"Text Block"},
     *     summary="Получение списка текстовых блоков",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Текстовые блокиы",
     *         @SWG\Schema(ref = "#/definitions/TextBlockIndexResponse")
     *     ),
     * )
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $response = \Yii::createObject([
            'class'    => TextBlockIndexResponse::class,
            'elements' => $this->repository->getModelsList(),
        ]);

        return $response;
    }
}