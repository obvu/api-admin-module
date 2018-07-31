<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 04.05.18
 * Time: 23:59
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\controllers\blog;


use Obvu\Modules\Api\Admin\controllers\base\BaseAdminController;
use Obvu\Modules\Api\AdminSubmodules\Content\components\post\object\PostAdminRepository;
use Obvu\Modules\Api\AdminSubmodules\Content\models\post\request\AdminPostInfoRequest;
use Obvu\Modules\Api\AdminSubmodules\Content\models\post\response\PostIndexResponse;

class PostController extends BaseAdminController
{
    /**
     * @var PostAdminRepository
     */
    private $postAdminRepository;

    /**
     * PostController constructor.
     * @param string $id
     * @param $module
     * @param PostAdminRepository $postAdminRepository
     * @param array $config
     */
    public function __construct(
        string $id,
        $module,
        PostAdminRepository $postAdminRepository,
        array $config = [])
    {
        $this->postAdminRepository = $postAdminRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * @SWG\Get(path="/content/blog/posts/{postId}",
     *     tags={"blog"},
     *     summary="Получение информации о посте",
     *     @SWG\Parameter(
     *          in="path",
     *          name="postId",
     *          type="integer",
     *          required=true
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Модель и информации о фонде",
     *         @SWG\Schema(ref = "#/definitions/AdminPostModel")
     *     ),
     * )
     * @param $id
     * @return
     */
    public function actionView($id)
    {
        return $this->postAdminRepository->getModel($id);
    }

    /**
     * @SWG\Post(path="/content/blog/posts",
     *     tags={"blog"},
     *     summary="Создание фонда",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/AdminPostInfoRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Модель и информации о посте",
     *         @SWG\Schema(ref = "#/definitions/AdminPostModel")
     *     ),
     * )
     * @return mixed
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionCreate()
    {
        return $this->postAdminRepository->createModel(AdminPostInfoRequest::createRequest());
    }

    /**
     * @SWG\Put(path="/content/blog/posts/{postId}",
     *     tags={"blog"},
     *     summary="Создание фонда",
     *     @SWG\Parameter(
     *          in="path",
     *          name="postId",
     *          type="integer",
     *          required=true
     *     ),
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/AdminPostInfoRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Модель и информации о посте",
     *         @SWG\Schema(ref = "#/definitions/AdminPostModel")
     *     ),
     * )
     * @param $id
     * @return mixed
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionUpdate($id)
    {
        return $this->postAdminRepository->updateModel($id, AdminPostInfoRequest::createRequest());
    }


    /**
     * @SWG\GET(path="/content/blog/posts",
     *     tags={"blog"},
     *     summary="Получение списка постов",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив постов",
     *         @SWG\Schema(ref = "#/definitions/PostIndexResponse")
     *     ),
     * )
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $response = \Yii::createObject([
            'class'    => PostIndexResponse::class,
            'elements' => $this->postAdminRepository->getModelsList(),
        ]);

        return $response;
    }
}