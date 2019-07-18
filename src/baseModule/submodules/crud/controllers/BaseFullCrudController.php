<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\controllers;


use Obvu\Modules\Api\Admin\controllers\base\BaseAdminController;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use yii\web\ForbiddenHttpException;

class BaseFullCrudController extends BaseAdminController
{
    /**
     * @var FullCrudModule
     */
    public $module;


    public function beforeAction($action)
    {
        $result = parent::beforeAction($action);
        $role = $this->module->accessRole;
        if ($role && !\Yii::$app->request->isOptions) {
            if (!\Yii::$app->user->can($role)) {
                throw new ForbiddenHttpException('Нет доступа');
            }
        }

        return $result;
    }
}
