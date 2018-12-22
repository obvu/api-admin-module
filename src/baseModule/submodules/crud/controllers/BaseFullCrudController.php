<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\controllers;


use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use Zvinger\BaseClasses\api\controllers\BaseApiController;

class BaseFullCrudController extends BaseApiController
{
    /**
     * @var FullCrudModule
     */
    public $module;
}
