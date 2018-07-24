<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 24.05.18
 * Time: 9:52
 */

namespace ObvuCrudModule\controllers;


use ObvuCrudModule\ObvuCrudModule;
use Zvinger\BaseClasses\api\controllers\BaseApiController;

class BaseCrudController extends BaseApiController
{
    /**
     * @var ObvuCrudModule
     */
    public $module;
}