<?php


namespace Obvu\Modules\Api\AdminSubmodules\submodules\src\submodules\siteInfo\controllers;


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