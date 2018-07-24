<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 15:58
 */

namespace Obvu\Modules\Api\Admin\AdminSubmodules\Content\controllers\base;


use Obvu\Modules\Api\Admin\controllers\base\BaseAdminController;
use Obvu\Modules\Api\Admin\AdminSubmodules\Content\ApiAdminDwyContentModule;

class BaseAdminContentController extends BaseAdminController
{
    /**
     * @var ApiAdminDwyContentModule
     */
    public $module;
}