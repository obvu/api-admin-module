<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 15:05
 */

namespace Obvu\Modules\Api\Admin\submodules\event\components;

use app\components\event\models\create\attributes\EventDateAttribute;
use app\components\event\models\create\attributes\EventFileAttribute;
use app\components\event\models\create\EventCreateData;
use app\models\work\event\file\EventFile;
use app\models\work\event\object\EventObject;
use Obvu\Modules\Api\Admin\submodules\event\requests\event\create\EventCreateRequest;
use Obvu\Modules\Api\Admin\submodules\event\requests\event\update\EventUpdateRequest;
use Obvu\Modules\Api\Admin\submodules\event\responses\event\view\EventViewResponse;
use Obvu\Modules\Api\Admin\responses\file\UploadFileResponse;
use yii\helpers\ArrayHelper;
use Zvinger\BaseClasses\app\modules\fileStorage\VendorFileStorageModule;

class EventAdminComponent
{
    /**
     * @param EventCreateRequest $createRequest
     * @return EventViewResponse
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     * @throws \yii\base\InvalidConfigException
     */
    public function createEvent(EventCreateRequest $createRequest)
    {
        $eventCreateData = new EventCreateData();
        $eventCreateData->title = $createRequest->title;
        $eventCreateData->description = $createRequest->description;
        $eventCreateData->dates = $createRequest->dates;
        $eventCreateData->locationId = $createRequest->locationId;
        if ($createRequest->photoId) {
            $file = new EventFileAttribute();
            $file->fileId = $createRequest->photoId;
            $file->fileType = EventFileAttribute::TYPE_PHOTO;
            $eventCreateData->eventFiles[] = $file;
        }
        $eventObject = \Yii::$app->event->createEvent($eventCreateData);

        return $this->getEventData($eventObject);
    }

    /**
     * @param EventObject $eventObject
     * @param EventUpdateRequest $updateRequest
     * @return EventViewResponse
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     */
    public function updateEvent(EventObject $eventObject, EventUpdateRequest $updateRequest)
    {
        $eventCreateData = new EventCreateData();
        $eventCreateData->title = $updateRequest->title;
        $eventCreateData->description = $updateRequest->description;
        $eventCreateData->dates = $updateRequest->dates;
        $eventCreateData->locationId = $updateRequest->locationId;
        if ($updateRequest->photoId) {
            $file = new EventFileAttribute();
            $file->fileId = $updateRequest->photoId;
            $file->fileType = EventFileAttribute::TYPE_PHOTO;
            $eventCreateData->eventFiles[] = $file;
        }
        $eventObject = \Yii::$app->event->updateEvent($eventCreateData, $eventObject);

        return $this->getEventData($eventObject);
    }

    /**
     * @param EventObject $eventObject
     * @return EventViewResponse
     * @throws \Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function getEventData(EventObject $eventObject)
    {
        $result = new EventViewResponse();
        $result->title = $eventObject->miscInfo->title;
        $result->id = $eventObject->id;
        $result->description = $eventObject->miscInfo->description;
        $result->dates = [];
        $result->locationId = $eventObject->miscInfo->locationId;
        $dates = $eventObject->eventDates;
        $resultDates = [];
        foreach ($dates as $date) {
            $dateObject = new EventDateAttribute();
            $dateObject->date = date('Y-m-d', $date->timestamp_start);
            $dateObject->timestampStart = $date->timestamp_start;
            $dateObject->timestampFinish = $date->timestamp_finish;
            $dateObject->timeStart = date("H:i", $date->timestamp_start);
            $dateObject->timeFinish = date("H:i", $date->timestamp_finish);
            $resultDates[] = $dateObject;
        }
        /** @var EventFile $photo */
        $photo = ArrayHelper::getValue($eventObject->eventFiles, 0);
        if (!empty($photo)) {
            $fileInfo = new UploadFileResponse();
            $fileInfo->fileId = $photo->file_id;
            /** @var VendorFileStorageModule $fileStorageModule */
            $fileStorageModule = \Yii::$app->getModule(FILE_STORAGE_MODULE);
            $fileInfo->fullUrl = $fileStorageModule->storage->getFile($fileInfo->fileId)->getFullUrl();
            $result->photoData = $fileInfo;
        }
        $result->dates = $resultDates;

        return $result;
    }
}