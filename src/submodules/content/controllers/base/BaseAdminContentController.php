<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 15:58
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\controllers\base;


use Obvu\Modules\Api\Admin\controllers\base\BaseAdminController;
use Obvu\Modules\Api\AdminSubmodules\Content\ContentModule;

class BaseAdminContentController extends BaseAdminController
{
    /**
     * @var ContentModule
     */
    public $module;
}