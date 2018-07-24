<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 13:25
 */

namespace Obvu\Modules\Api\Admin\submodules\event\controllers;

use app\models\work\event\object\EventObject;
use Obvu\Modules\Api\Admin\controllers\base\BaseAdminController;
use Obvu\Modules\Api\Admin\submodules\event\requests\event\create\EventCreateRequest;
use Obvu\Modules\Api\Admin\submodules\event\requests\event\update\EventUpdateRequest;
use Obvu\Modules\Api\Admin\submodules\event\responses\event\index\EventsIndexResponse;
use Obvu\Modules\Api\Admin\submodules\event\responses\event\index\EventsResponseSingleElement;
use Obvu\Modules\Api\Admin\submodules\event\responses\event\view\EventViewResponse;
use yii\web\NotFoundHttpException;


class InformationController extends BaseAdminController
{
    /**
     * @SWG\Get(path="/dwy/event/information",
     *     tags={"Calendar"},
     *     summary="Получение списка мероприятий",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/EventIndexRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/EventsIndexResponse")
     *     ),
     * )
     */
    public function actionIndex()
    {
        $eventObjects = EventObject::find()->all();
        $result = [];
        foreach ($eventObjects as $eventObject) {
            $object = new EventsResponseSingleElement();
            $object->id = $eventObject->id;
            $object->eventTitle = $eventObject->getMiscInfo()->getNoCheck('title');

            $result[] = $object;
        }
        $response = new EventsIndexResponse();
        $response->objects = $result;

        return $result;
    }

    /**
     * @param $id
     * @return EventViewResponse
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\base\InvalidConfigException
     *
     * @SWG\GET(path="/dwy/event/information/{eventId}",
     *     tags={"Calendar"},
     *     summary="Получение мероприятия",
     *     @SWG\Parameter(
     *          in="path",
     *          name="eventId",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/EventViewResponse")
     *     ),
     * )
     */
    public function actionView($id)
    {
        return $this->module->event->getEventData($this->getEventObject($id));
    }

    /**
     * @param $id
     * @return EventViewResponse
     * @throws NotFoundHttpException
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     *
     * @SWG\Put(path="/dwy/event/information/{eventId}",
     *     tags={"Calendar"},
     *     summary="Редактирование мероприятия",
     *     @SWG\Parameter(
     *          in="path",
     *          name="eventId",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/EventUpdateRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/EventViewResponse")
     *     ),
     * )
     */
    public function actionUpdate($id)
    {
        $eventObject = $this->getEventObject($id);
        $request = new EventUpdateRequest(\Yii::$app->request->post());

        return $this->module->event->updateEvent($eventObject, $request);
    }

    /**
     * @SWG\Post(path="/dwy/event/information",
     *     tags={"Calendar"},
     *     summary="Создания мероприятия",
     *     @SWG\Parameter(
     *          in="query",
     *          name="eventId",
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          @SWG\Schema(ref = "#/definitions/EventUpdateRequest")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Массив мероприятий",
     *         @SWG\Schema(ref = "#/definitions/EventViewResponse")
     *     ),
     * )
     *
     *
     * @return EventViewResponse
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     */
    public function actionCreate()
    {
        $request = new EventCreateRequest(\Yii::$app->request->post());

        return $this->module->event->createEvent($request);
    }

    /**
     * @param $id
     * @return null|EventObject
     * @throws NotFoundHttpException
     */
    private function getEventObject($id)
    {
        $object = EventObject::findOne($id);
        if (empty($object)) {
            throw new NotFoundHttpException("Нет такого мероприятия");
        }

        return $object;
    }
}