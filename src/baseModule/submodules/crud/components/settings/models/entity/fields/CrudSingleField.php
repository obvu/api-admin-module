<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields;

use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\base\BaseCrudSingleField;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use Yii;

class CrudSingleField extends BaseCrudSingleField
{
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

    public $options;

    public function init()
    {
        parent::init();
        if (empty($this->variants)) {
            if (!empty($this->variantsCallBack)) {
                $variantsCallBack = $this->variantsCallBack;
                /** @var FullCrudModule $module */
                $module = Yii::createObject(FullCrudModule::class);
                if ($module->getElementComponent()->isDeepLoad()) {
                    $module->getElementComponent()->setDeepLoad(false);
                    $this->variants = $variantsCallBack($this, $module);
                    $module->getElementComponent()->setDeepLoad(true);
                } else {
                    $this->variants = [];
                }
            } elseif ($this->type === $this::TYPE_BOOLEAN_SELECT) {
                $boolVariants = [
                    Yii::createObject(
                        [
                            'class' => CrudSingleSelectVariant::class,
                            'key' => 0,
                            'value' => 'Нет',
                        ]
                    ),
                    Yii::createObject(
                        [
                            'class' => CrudSingleSelectVariant::class,
                            'key' => 1,
                            'value' => 'Да',
                        ]
                    ),
                ];
                $this->variants = $boolVariants;
                $this->type = $this::TYPE_SELECT;
            }
        }
    }
}
