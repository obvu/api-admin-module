<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity;


use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\base\BaseEditDataBlock;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\multipleBlock\MultipleEditDataBlock;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\CrudSingleField;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\rawData\CrudRawData;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

/**
 * Class CrudSingleEntity
 * @package Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity
 * @SWG\Definition()
 */
class CrudSingleEntity extends BaseObject
{
    /**
     * @var string
     * @SWG\Property()
     */
    public $title;

    /**
     * @var string
     * @SWG\Property()
     */
    public $key;

    /**
     * @var CrudSingleField[]|BaseEditDataBlock[]
     * @SWG\Property()
     */
    public $fields;

    /**
     * @var CrudRawData[]
     * @SWG\Property()
     */
    public $rawData;

    /**
     * @var bool
     * @SWG\Property()
     */
    public $aggregateEntity = false;

    public function init()
    {
        parent::init();
        \Yii::$app->currentFullCrud->getFieldHelper()->handleFields($this->aggregateEntity, $this->fields);
    }


    /**
     * @param $fieldKey
     * @return CrudSingleField
     */
    public function findField($fieldKey)
    {
        foreach ($this->fields as $field) {
            if ($field instanceof CrudSingleField && $field->name === $fieldKey) {
                return $field;
            }
        }
    }

    /**
     * @param $blockKey
     * @return MultipleEditDataBlock
     */
    public function findMultipleBlock($blockKey)
    {
        foreach ($this->fields as $field) {
            if ($field instanceof BaseEditDataBlock && ($field->entityKey === $blockKey || $field->name === $blockKey)) {
                return $field;
            }
        }
    }

    public function hasSubEntity(): bool
    {
        $result = false;

        foreach ($this->fields as $field) {
            if ($field instanceof BaseEditDataBlock) {
                $result = true;
                break;
            }
        }

        return $result;
    }
}
