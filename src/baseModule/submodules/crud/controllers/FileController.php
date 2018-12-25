<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 25.12.2018
 * Time: 0:12
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\controllers;


use Obvu\Modules\Api\Admin\controllers\base\BaseAdminController;
use Obvu\Modules\Api\Admin\responses\file\UploadFileResponse;
use yii\helpers\Json;
use Zvinger\BaseClasses\app\modules\fileStorage\VendorFileStorageModule;

class FileController extends BaseAdminController
{

    public function actionUpload()
    {
        /** @var VendorFileStorageModule $fileStorageModule */
        $fileStorageModule = \Yii::$app->getModule(FILE_STORAGE_MODULE);
        $savedFileModel = $fileStorageModule->storage->uploadPostFile('image');
        $response = new UploadFileResponse();
        $response->fullUrl = $savedFileModel->getFullUrl();
        $response->fileId = $savedFileModel->fileStorageElement->id;

        return $response;
    }


    public function actionUploadMultiple()
    {
        /** @var VendorFileStorageModule $fileStorageModule */
        $fileStorageModule = \Yii::$app->getModule(FILE_STORAGE_MODULE);
        $savedFileModels = $fileStorageModule->storage->uploadPostFiles('files');
        $responses = [];
        foreach ($savedFileModels as $savedFileModel) {
            $response = new UploadFileResponse();
            $response->fullUrl = $savedFileModel->getFullUrl();
            $response->fileId = $savedFileModel->fileStorageElement->id;
            $response->fileInfo = Json::decode($savedFileModel->fileStorageElement->info);
            $responses[] = $response;
        }

        return $responses;
    }
}
