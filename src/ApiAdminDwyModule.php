<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 13:23
 */

namespace Obvu\Modules\Api\Admin;

use Obvu\Modules\Api\Admin\submodules\event\components\EventAdminComponent;
use Obvu\Modules\Api\Admin\submodules\content\ApiAdminDwyContentModule;
use Obvu\Modules\Api\Admin\submodules\event\EventModule;
use Obvu\Modules\Api\AdminSubmodules\Crud\CrudModule;
use ReflectionClass;
use yii\base\Application;
use yii\base\BootstrapInterface;
use Zvinger\BaseClasses\api\controllers\ApiDocsSwaggerController;
use Zvinger\BaseClasses\app\modules\api\admin\v1\AdminApiVendorModule;
use Zvinger\BaseClasses\app\modules\api\ApiModule;

/**
 * Class ApiAdminDwyModule
 * @package Obvu\Modules\Api\Admin
 *
 * @property EventAdminComponent event
 */
class ApiAdminDwyModule extends ApiModule implements BootstrapInterface
{
    public $docsScanPaths = [];

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            ['class' => 'yii\rest\UrlRule', 'controller' => $this->uniqueId . '/event/information', 'pluralize' => false],
            ['class' => 'yii\rest\UrlRule', 'controller' => $this->uniqueId . '/content/text-block'],
            ['class' => 'yii\rest\UrlRule', 'controller' => $this->uniqueId . '/content/blog/post'],
            ['class' => 'yii\rest\UrlRule', 'controller' => $this->uniqueId . '/content/blog/post-category'],
            ['class' => 'yii\rest\UrlRule', 'controller' => $this->uniqueId . '/content/page'],
            ['class' => 'yii\rest\UrlRule', 'controller' => $this->uniqueId . '/content/widget'],
        ]);
        $components = [
            'event' => EventAdminComponent::class,
        ];
        $this->setComponents($components);
    }


    public function init()
    {
        $this->docsScanPaths[] = $this->basePath;
        $this->docsScanPaths[] = dirname((new ReflectionClass(AdminApiVendorModule::class))->getFileName());

        $this->controllerMap = [
            'docs' => [
                'class'     => ApiDocsSwaggerController::class,
                'scanPaths' => $this->docsScanPaths,
            ],
        ];
        $this->modules = [
            'content' => [
                'class'         => ApiAdminDwyContentModule::class,
                'docsScanPaths' => $this->docsScanPaths,
            ],
            'crud'    => [
                'class' => CrudModule::class,
            ],
            'event' => EventModule::class
        ];
        parent::init();
    }


}