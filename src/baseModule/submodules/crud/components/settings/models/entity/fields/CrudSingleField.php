<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields;


use yii\base\BaseObject;

class CrudSingleField extends BaseObject
{
    const TYPE_INPUT_TEXT = 'input_text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_SELECT = 'select';
    const TYPE_DATE = 'input_text';
    const TYPE_FILE_PHOTO = 'file_photo';
    const TYPE_FILE_SIMPLE = 'file_photo';

    public $type;

    public $name;

    public $label;

    public $defaultValue = null;

    /**
     * @var CrudSingleSelectVariant[]
     */
    public $variants = null;

    public $multiple = false;

    public $component = 'default';

    public $fileName = null;

    /**
     * @var callable
     */
    public $variantsCallBack = null;

    public function init()
    {
        parent::init();
        if (empty($this->variants)) {
            if (!empty($this->variantsCallBack)) {
                $variantsCallBack = $this->variantsCallBack;
                $this->variants = $variantsCallBack($this, \Yii::$app->controller->module);
            }
        }
    }
}
