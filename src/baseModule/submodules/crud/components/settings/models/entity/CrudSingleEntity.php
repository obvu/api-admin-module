<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity;


use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\base\BaseEditDataBlock;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\multipleBlock\MultipleEditDataBlock;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\CrudSingleField;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\rawData\CrudRawData;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use yii\base\BaseObject;

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
     * @var callable|null
     */
    public $afterFullCallback = null;

    /**
     * @var bool
     * @SWG\Property()
     */
    public $aggregateEntity = false;

    public $specialFilterClass = null;

    /**
     * @var callable
     * @SWG\Property()
     */
    public $searchCallBack;

    /**
     * @var CrudSingleField[]
     * @SWG\Property()
     */
    public $filterFields;

    public function init()
    {
        parent::init();
        FullCrudModule::getCurrentFullCrudHandlingModule()->getFieldHelper()->handleFields(
            $this->aggregateEntity,
            $this->fields
        );
    }

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
