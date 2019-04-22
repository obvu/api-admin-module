<?php

namespace Obvu\Modules\Api\Admin\submodules\siteInfo\controllers;


use Obvu\Modules\Api\Admin\submodules\siteInfo\SiteInfoModule;
use Zvinger\BaseClasses\api\controllers\BaseApiController;

class BaseSiteInfoController extends BaseApiController
{
    /**
     * @var SiteInfoModule
     */
    public $module;
}