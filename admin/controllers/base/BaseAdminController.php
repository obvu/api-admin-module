<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 13:25
 */

namespace Obvu\Modules\Api\Admin\controllers\base;

use Obvu\Modules\Api\Admin\ApiAdminDwyModule;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\OptionsAction;
use Zvinger\BaseClasses\api\controllers\BaseApiController;

class BaseAdminController extends BaseApiController
{
    /**
     * @var ApiAdminDwyModule
     */
    public $module;


    public function actions()
    {
        return [
            'options' => [
                'class' => OptionsAction::class,
            ],
        ];
    }

    public function behaviors()
    {
        $old = parent::behaviors();
        $behaviors = [];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        $array_merge = array_merge($old, $behaviors);

        return $array_merge;
    }
}