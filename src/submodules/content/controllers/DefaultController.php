<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 13:29
 */

namespace Obvu\Modules\Api\Admin\submodules\content\controllers;


use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class DefaultController extends Controller
{
    /**
     * @throws BadRequestHttpException
     */
    public function actionIndex()
    {
        throw new BadRequestHttpException("Use routes");
    }
}