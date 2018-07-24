<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 24.05.18
 * Time: 8:14
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud;


use Obvu\Modules\Api\AdminSubmodules\Crud\components\element\ApiCrudElementComponent;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

/**
 * Class ApiAdminDwyCrudModule
 * @package ObvuCrudModule
 * @property ApiCrudElementComponent $apiElement
 */
class CrudModule extends Module implements BootstrapInterface
{
    public function init()
    {
        $this->components = [
            'apiElement' => ApiCrudElementComponent::class,
        ];
        parent::init();
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            [
                'class'      => 'yii\rest\UrlRule',
                'controller' => $this->uniqueId . '/element',
                'tokens'     => [
                    '{elementType}' => '<elementType>',
                    '{elementId}'  => '<elementId:\\d[\\d,]*>',
                ],
                'patterns'   => [
                    'GET,HEAD {elementType}/{elementId}' => 'view',
                    'PUT,PATCH {elementType}/{elementId}' => 'update',
                    'GET {elementType}' => 'index',
                    'POST {elementType}' => 'create',
                    'OPTIONS {elementType}' => 'options',
                    'OPTIONS {elementType}/{elementId}' => 'options',
                ],
                'pluralize' => false
            ],
        ]);
    }
}