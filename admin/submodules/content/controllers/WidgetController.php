<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 14:53
 */

namespace Obvu\Modules\Api\Admin\submodules\content\controllers;


use Obvu\Modules\Api\Admin\submodules\content\components\page\ApiAdminPageRepository;
use Obvu\Modules\Api\Admin\submodules\content\components\widget\ApiAdminWidgetRepository;
use Obvu\Modules\Api\Admin\submodules\content\controllers\base\BaseAdminContentController;
use Obvu\Modules\Api\Admin\submodules\content\models\page\request\PageInfoRequest;
use Obvu\Modules\Api\Admin\submodules\content\models\page\response\PageIndexResponse;
use Obvu\Modules\Api\Admin\submodules\content\models\widget\request\WidgetInfoRequest;
use Obvu\Modules\Api\Admin\submodules\content\models\widget\WidgetModel;
use Obvu\Modules\Api\Admin\submodules\content\models\widget\WidgetsInfo;

class WidgetController extends BaseAdminContentController
{

    /**
     * @var ApiAdminWidgetRepository
     */
    private $repository;

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
     *     path="/dwy/content/widgets",
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
     *     path="/dwy/content/widgets",
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