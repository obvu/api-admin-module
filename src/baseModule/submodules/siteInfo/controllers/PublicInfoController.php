<?php


namespace Obvu\Modules\Api\Admin\submodules\siteInfo\controllers;


use Zvinger\BaseClasses\api\controllers\BaseApiController;

class PublicInfoController extends BaseApiController
{
    public function actionGetInfo()
    {
        return [
            'title' => '123',
        ];
    }
}