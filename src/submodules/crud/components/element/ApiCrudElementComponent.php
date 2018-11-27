<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 24.05.18
 * Time: 9:51
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\components\element;


use Obvu\Modules\Api\AdminSubmodules\Crud\components\database\models\crud\element\CrudElementObject;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\element\event\HandleElementEvent;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\element\parser\base\BaseParser;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\element\parser\base\SimpleParser;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\element\parser\LocationsParser;
use Obvu\Modules\Api\AdminSubmodules\Crud\CrudModule;
use Obvu\Modules\Api\AdminSubmodules\Crud\models\view\response\CrudViewModelResponse;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use Zvinger\BaseClasses\app\exceptions\model\ModelValidateException;

class ApiCrudElementComponent
{
    const TYPE_LOCATIONS = 'locations';

    public $parsersMap = [];

    /**
     * @param $type
     * @param $id
     * @return CrudViewModelResponse
     * @throws \Exception
     */
    public function viewElement($type, $id): CrudViewModelResponse
    {
        $result = $this->getHandler($type)->getSingle($id);
        if ($result) {
            return $result;
        }
        $object = CrudElementObject::find()->object($type, $id)->one();
        if (empty($object)) {
            throw new NotFoundHttpException("Object not found: $type -> $id");
        }

        return $this->getResponse($object);
    }

    /**
     * @param $type
     * @return CrudViewModelResponse[]
     * @throws \Exception
     */
    public function listElement($type)
    {
        $result = $this->getHandler($type)->getList();
        if ($result) {
            return $result;
        }
        $objects = CrudElementObject::find()
            ->byType($type)
            ->orderBy('sort, cast(data_id as unsigned)')
            ->all();
        $result = [];
        foreach ($objects as $object) {
            $result[] = $this->getResponse($object);
        }

        return $result;
    }

    /**
     * @param $type
     * @param $id
     * @param $data
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function updateElement($type, $id, $data)
    {
        $result = $this->getHandler($type)->update($id, $data);
        if ($result) {
            return $result;
        }
        $object = CrudElementObject::find()->object($type, $id)->one();
        if (empty($object)) {
            throw new NotFoundHttpException("Not found element for $type -> $id");
        }

        $object->setDataObject($data);
        $object->save();

        return $this->getResponse($object);
    }

    /**
     * @param $type
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function createElement($type, $data)
    {
        $result = $this->getHandler($type)->create($data);
        if ($result) {
            return $result;
        }
        $byType = CrudElementObject::find()
            ->select('max(cast(data_id as unsigned))')
            ->byType($type);
        $largestId = $byType
            ->scalar();
        $object = new CrudElementObject(
            [
                'type' => $type,
                'dataObject' => $data,
                'data_id' => strval($largestId + 1),
            ]
        );
        if (!$object->save()) {
            throw new ModelValidateException($object);
        }

        return $this->getResponse($object);
    }

    /**
     * @param $object CrudElementObject
     * @return CrudViewModelResponse
     * @throws \Exception
     */
    public function getResponse($object)
    {
        return \Yii::createObject(
            [
                'class' => CrudViewModelResponse::class,
                'data' => $this->getParser($object->type)->parseObject($object),
                'dataId' => (int)$object->data_id,
                'dataTitle' => $this->getParser($object->type)->parseTitle($object),
                'type' => $object->type,
                'object' => $object,
            ]
        );
    }

    /**
     * @param $type
     * @return BaseParser
     * @throws \Exception
     */
    private function getParser($type): BaseParser
    {
        $className = ArrayHelper::getValue($this->parsersMap, $type);
        if (class_exists($className)) {
            return new $className;
        } else {
            return new SimpleParser();
        }
    }

    /**
     * @param $type
     * @return \Obvu\Modules\Api\AdminSubmodules\Crud\helpers\BaseHandler
     */
    protected function getHandler($type): \Obvu\Modules\Api\AdminSubmodules\Crud\helpers\BaseHandler
    {
        return CrudModule::getInstance()->getHandler($type);
    }
}