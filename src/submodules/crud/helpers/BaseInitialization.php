<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 27.11.2018
 * Time: 13:59
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\helpers;

use function League\Uri\parse;
use Obvu\Modules\Api\AdminSubmodules\Crud\CrudModule;
use yii\base\BaseObject;

abstract class BaseInitialization extends BaseObject
{
    protected $handlers = [];
    /**
     * @var CrudModule
     */
    protected $module;

    public function __construct(CrudModule $module)
    {
        $this->module = $module;
        parent::__construct([]);
    }

    /**
     * @param $type
     * @return BaseHandler
     */
    public function getHandler($type)
    {
        /** @var BaseHandler $handler */
        $handler = null;
        if (!empty($this->handlers[$type])) {
            $handler = new $this->handlers[$type];
        } else {
            return new EmptyCrudHandler();
        }
        $handler->type = $type;

        return $handler;
    }
}