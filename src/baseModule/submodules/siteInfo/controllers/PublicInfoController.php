<?php

namespace Obvu\Modules\Api\Admin\submodules\siteInfo\controllers;

class PublicInfoController extends BaseSiteInfoController
{
    public function actionPageInfo($page)
    {
        return $this->module->getDataGetter()->getForPage($page, \Yii::$app->request->post());
    }

    public function actionCommonInfo()
    {
        return $this->module->getDataGetter()->getCommonInfo(\Yii::$app->request->post());
    }

    public function actionBlockInfo($blockName)
    {
        return $this->module->getDataGetter()->getBlockInfo($blockName, \Yii::$app->request->post());
    }
}