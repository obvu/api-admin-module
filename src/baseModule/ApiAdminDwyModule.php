<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 13:23
 */

namespace Obvu\Modules\Api\Admin;

use Obvu\Modules\Api\Admin\AdminSubmodules\Content\ApiAdminDwyContentModule;
use ReflectionClass;
use yii\base\Application;
use yii\base\BootstrapInterface;
use Zvinger\BaseClasses\api\controllers\ApiDocsSwaggerController;
use Zvinger\BaseClasses\app\modules\api\admin\v1\AdminApiVendorModule;
use Zvinger\BaseClasses\app\modules\api\ApiModule;

/**
 * Class ApiAdminDwyModule
 * @package Obvu\Modules\Api\Admin
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
    }

    /**
     * @throws \ReflectionException
     */
    public function init()
    {
        $this->docsScanPaths[] = $this->basePath;
        $this->docsScanPaths[] = \dirname((new ReflectionClass(AdminApiVendorModule::class))->getFileName());

        $this->controllerMap = [
            'content' => [
                'class'         => ApiAdminDwyContentModule::class,
                'docsScanPaths' => $this->docsScanPaths,
            ],
            'docs'    => [
                'class'     => ApiDocsSwaggerController::class,
                'scanPaths' => $this->docsScanPaths,
            ],
        ];
        parent::init();
    }
}
