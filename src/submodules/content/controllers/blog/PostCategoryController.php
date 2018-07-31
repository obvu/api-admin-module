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
use Obvu\Modules\Api\AdminSubmodules\Content\components\post\category\PostCategoryAdminRepository;
use Obvu\Modules\Api\AdminSubmodules\Content\models\post\request\AdminPostInfoRequest;
use Obvu\Modules\Api\AdminSubmodules\Content\models\post\response\PostIndexResponse;
use Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory\request\PostCategoryInfoRequest;
use yii\rest\Controller;

class PostCategoryController extends BaseAdminController
{
    /**
     * @var PostCategoryAdminRepository
     */
    private $postCategoryAdminRepository;

    /**
     * PostCategoryController constructor.
     * @param string $id
     * @param $module
     * @param PostCategoryAdminRepository $postCategoryAdminRepository
     * @param array $config
     */
    public function __construct(
        string $id,
        $module,
        PostCategoryAdminRepository $postCategoryAdminRepository,
        array $config = [])
    {
        $this->postCategoryAdminRepository = $postCategoryAdminRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * @SWG\Get(path="/content/blog/post-categories/{postId}",
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
     *         @SWG\Schema(ref = "#/definitions/PostCategoryModel")
     *     ),
     * )
     * @param $id
     * @return
     */
    public function actionView($id)
    {
        return $this->postCategoryAdminRepository->getModel($id);
    }

    /**
     * @SWG\Post(path="/content/blog/post-categories",
     *     tags={"blog"},
     *     summary="Создание фонда",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/PostCategoryInfoRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Модель и информации о посте",
     *         @SWG\Schema(ref = "#/definitions/PostCategoryModel")
     *     ),
     * )
     * @return mixed
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionCreate()
    {
        $request = PostCategoryInfoRequest::createRequest();

        return $this->postCategoryAdminRepository->createModel($request);
    }

    /**
     * @SWG\Put(path="/content/blog/post-categories/{postId}",
     *     tags={"blog"},
     *     summary="Сохранение категории",
     *     @SWG\Parameter(
     *          in="path",
     *          name="postId",
     *          type="integer",
     *          required=true
     *     ),
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/PostCategoryInfoRequest")
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
    public function actionUpdate($id)
    {
        return $this->postCategoryAdminRepository->updateModel($id, PostCategoryInfoRequest::createRequest());
    }


    /**
     * @SWG\GET(path="/content/blog/post-categories",
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
            'elements' => $this->postCategoryAdminRepository->getModelsList(),
        ]);

        return $response;
    }
}