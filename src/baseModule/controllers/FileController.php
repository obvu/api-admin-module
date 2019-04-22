<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 16:42
 */

namespace Obvu\Modules\Api\Admin\controllers;

use Obvu\Modules\Api\Admin\controllers\base\BaseAdminController;
use Obvu\Modules\Api\Admin\responses\file\UploadFileResponse;
use Zvinger\BaseClasses\app\modules\fileStorage\VendorFileStorageModule;

if (!defined("FILE_STORAGE_MODULE")) {
    define("FILE_STORAGE_MODULE", 'fileStorage');
}


class FileController extends BaseAdminController
{
    /**
     *
     * @SWG\Post(path="/file/upload",
     *     tags={"File"},
     *     summary="Загрузка файла",
     *     consumes={"multipart/form-data"},
     *     @SWG\Parameter(
     *          in="formData",
     *          name="image",
     *          type="file",
     *          description="Файл для загрузки"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/UploadFileResponse")
     *     ),
     * )
     *
     * @return UploadFileResponse
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     * @throws \yii\base\InvalidConfigException
     * @throws \Exception
     *
     */
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

    /**
     *
     * @SWG\Post(path="/file/upload-multiple",
     *     tags={"File"},
     *     summary="Загрузка файлов",
     *     consumes={"multipart/form-data"},
     *     @SWG\Parameter(
     *          in="formData",
     *          name="files[]",
     *          type="file",
     *          description="Файл для загрузки"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/UploadFileResponse")
     *     ),
     * )
     *
     * @return UploadFileResponse
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     * @throws \yii\base\InvalidConfigException
     * @throws \Exception
     */
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
            $responses[] = $response;
        }

        return $responses;
    }
}
