<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 14:53
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\controllers;


use Obvu\Modules\Api\AdminSubmodules\Content\components\widget\ApiAdminWidgetRepository;
use Obvu\Modules\Api\AdminSubmodules\Content\controllers\base\BaseAdminContentController;
use Obvu\Modules\Api\AdminSubmodules\Content\models\widget\request\WidgetInfoRequest;
use Obvu\Modules\Api\AdminSubmodules\Content\models\widget\WidgetsInfo;

class WidgetController extends BaseAdminContentController
{

    /**
     * @var ApiAdminWidgetRepository
     */
    private $repository;

    /**
     * WidgetController constructor.
     * @param string $id
     * @param $module
     * @param ApiAdminWidgetRepository $repository
     * @param array $config
     */
    public function __construct(
        string $id,
        $module,
        ApiAdminWidgetRepository $repository,
        array $config = [])
    {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
    }

    /**
     * @SWG\Post(
     *     path="/content/widgets",
     *     tags={"Widget"},
     *     summary="Редактирование виджетов",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/WidgetInfoRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешный ответ",
     *         @SWG\Schema(ref = "#/definitions/WidgetModel")
     *     ),
     * )
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionCreate()
    {
        return $this->repository->saveWidgetsInfo(WidgetInfoRequest::createRequest());
    }


    /**
     * @SWG\GET(
     *     path="/content/widgets",
     *     tags={"Widget"},
     *     summary="Получение значений виджетов",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Текстовые блокиы",
     *         @SWG\Schema(ref = "#/definitions/WidgetsInfo")
     *     ),
     * )
     * @return WidgetsInfo
     */
    public function actionIndex()
    {
        return $this->repository->getWidgetsInfo();
    }
}