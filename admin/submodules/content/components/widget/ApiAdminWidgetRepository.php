<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 09.05.18
 * Time: 14:27
 */

namespace Obvu\Modules\Api\Admin\submodules\content\components\widget;


use app\components\database\repository\content\widget\models\object\WidgetObject;
use app\components\database\repository\content\widget\WidgetRepository;
use Obvu\Modules\Api\Admin\submodules\content\models\widget\WidgetModel;
use Obvu\Modules\Api\Admin\submodules\content\models\widget\WidgetsInfo;
use Zvinger\BaseClasses\app\components\database\repository\BaseApiRepository;

class ApiAdminWidgetRepository extends BaseApiRepository
{
    /**
     * @var WidgetRepository
     */
    public $repository;

    public function __construct()
    {
        $this->setRepository(\Yii::createObject(WidgetRepository::class));
    }

    /**
     * @param WidgetObject $object
     * @return WidgetModel
     */
    public function fillApiModelFromObject($object)
    {
        $model = new WidgetModel();
        foreach ($object as $key => $value) {
            $model->{$key} = $value;
        }

        return $model;
    }

    /**
     * @param WidgetObject $object
     * @param WidgetModel $model
     * @return WidgetObject
     */
    public function fillObjectFromApiModel($object, $model)
    {
        $object->key = $model->key;
        $object->value = $model->value;

        return $object;
    }

    public function getWidgetsInfo()
    {
        $modelsList = $this->getModelsList();
        $response = new WidgetsInfo();
        foreach ($modelsList as $item) {
            $response->{$item->key} = $item->value;
        }

        return $response;
    }

    /**
     * @param $requestInfo
     * @return WidgetsInfo
     * @throws \Zvinger\BaseClasses\app\exceptions\model\ModelValidateException
     */
    public function saveWidgetsInfo($requestInfo)
    {
        foreach ($requestInfo as $key => $item) {
            $model = $this->getWidgetModelByKey($key);
            if (empty($model)) {
                $model = new WidgetModel();
                $model->key = $key;
                $model->value = $item;
                $this->createModel($model);

                continue;
            }
            $model->value = $requestInfo->{$key};
            $this->updateModel($model->id, $model);
        }

        return $this->getWidgetsInfo();
    }

    private function getWidgetModelByKey($key)
    {
        $object = $this->repository->getWidgetByKey($key);
        if (!empty($object)) {
            return $this->fillApiModelFromObject($object);
        }
    }
}