<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 21.01.2019
 * Time: 17:28
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\activeRecord;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base\BaseFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementListResult;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementSingleResult;
use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;
use Zvinger\BaseClasses\app\exceptions\model\ModelValidateException;

class ActiveRecordFullCrudElementHandler extends BaseFullCrudElementHandler
{
    /**
     * @var ActiveRecord
     */
    public $activeRecordClassName = null;

    public function init()
    {
        parent::init();
        if (empty($this->activeRecordClassName)) {
            throw new \Exception("No AR Class Set");
        }
    }


    public function getList($page = 1, $perPage = 20, $filter = []): FullCrudElementListResult
    {
        $query = $this->activeRecordClassName::find();
        $provider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
        $provider->pagination->page = $page - 1;
        $models = $provider->getModels();
        $resultModels = [];
        foreach ($models as $model) {
            $resultModels[] = $this->convertToData($model)->element;
        }

        return \Yii::createObject(
            [
                'class' => FullCrudElementListResult::class,
                'elements' => $resultModels,
                'totalCount' => $provider->totalCount,
            ]
        );
    }

    /**
     * @param $id
     * @return FullCrudElementSingleResult
     */
    public function getSingle($id)
    {
        return $this->convertToData($this->getObject($id));
    }

    private function convertToData(ActiveRecord $object)
    {
        $fullCrudElementSingleResult = \Yii::createObject(
            [
                'class' => FullCrudElementSingleResult::class,
                'element' => \Yii::createObject(
                    [
                        'class' => SingleCrudElementModel::class,
                        'fullData' => $object->attributes,
                        'listData' => $object->attributes,
                        'id' => $object->id,
                        'type' => $this->type,
                        'object' => $object,
                    ]
                ),
            ]
        );

        return $fullCrudElementSingleResult;
    }

    private function getObject($id)
    {
        $object = $this->activeRecordClassName::findOne($id);
        if (!$object) {
            throw new NotFoundHttpException("Object not found");
        }

        return $object;
    }

    public function create($data)
    {
        /** @var ActiveRecord $object */
        $object = new  $this->activeRecordClassName;
        \Yii::configure($object, $data);
        if (!$object->save()) {
            throw new ModelValidateException($object);
        }

        return $this->getSingle($object->id);
    }

    public function update($id, $data)
    {
        $object= $this->getObject($id);
        \Yii::configure($object, $data);
        if (!$object->save()) {
            throw new ModelValidateException($object);
        }

        return $this->getSingle($object->id);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
