<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 13:23
 */

namespace Obvu\Modules\Api\Admin;

use Obvu\Modules\Api\Admin\responses\file\UploadFileResponse;
use ReflectionClass;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\helpers\Json;
use Zvinger\BaseClasses\api\controllers\ApiDocsSwaggerController;
use Zvinger\BaseClasses\app\modules\api\admin\v1\AdminApiVendorModule;
use Zvinger\BaseClasses\app\modules\api\ApiModule;
use Zvinger\BaseClasses\app\modules\fileStorage\components\storage\models\SavedFileModel;
use Zvinger\BaseClasses\app\modules\fileStorage\VendorFileStorageModule;

/**
 * Class AdminModule
 * @package Obvu\Modules\Api\Admin
 */
class AdminModule extends ApiModule implements BootstrapInterface
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
//        $this->docsScanPaths[] = \dirname((new ReflectionClass(AdminApiVendorModule::class))->getFileName());
        foreach ($this->modules as $id => $module) {
            $this->docsScanPaths[] = $this->getModule($id)->basePath;
        }
        $this->controllerMap = [
            'docs' => [
                'class' => ApiDocsSwaggerController::class,
                'scanPaths' => $this->docsScanPaths,
            ],
        ];

        parent::init();
    }

    public static function getFileModel($fileId)
    {
        /** @var VendorFileStorageModule $fileStorageModule */
        $fileStorageModule = \Yii::$app->getModule(FILE_STORAGE_MODULE);

        return static::getFileModelByFileStorageElement($fileStorageModule->storage->getFile($fileId));
    }

    public static function getFileModelByFileStorageElement(SavedFileModel $savedFileModel)
    {
        $response = new UploadFileResponse();
        $response->fullUrl = $savedFileModel->getFullUrl();
        $response->fileId = $savedFileModel->fileStorageElement->id;
        $response->fileInfo = Json::decode($savedFileModel->fileStorageElement->info);

        return $response;
    }
}
