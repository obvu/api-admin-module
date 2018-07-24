<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 24.05.18
 * Time: 9:52
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\controllers;


use Obvu\Modules\Api\AdminSubmodules\Crud\CrudModule;
use Zvinger\BaseClasses\api\controllers\BaseApiController;

class BaseCrudController extends BaseApiController
{
    /**
     * @var CrudModule
     */
    public $module;
}