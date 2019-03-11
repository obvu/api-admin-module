<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields;

use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\AdminModule;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\base\BaseCrudSingleField;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use Yii;
use yii\helpers\ArrayHelper;

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
                $this->defaultValue = 0;
                $this->type = $this::TYPE_SELECT;
            }
        }
    }

    public function getGraphQLFieldType()
    {
        $map = [
            self::TYPE_INPUT_TEXT => Type::string(),
            self::TYPE_TEXT_EDITOR => Type::string(),
            self::TYPE_TEXTAREA => Type::string(),
            self::TYPE_SELECT => Type::string(),
            self::TYPE_DATE => Type::string(),
            self::TYPE_FILE_PHOTO => $this->multiple ? Type::listOf(Types::file()) : Types::file(),
            self::TYPE_FILE_SIMPLE => $this->multiple ? Type::listOf(Types::file()) : Types::file(),
        ];

        return ArrayHelper::getValue($map, $this->type);
    }

    /**
     * @return callable|null
     */
    public function getResolveFn()
    {
        $result = null;
        if (in_array($this->type, [self::TYPE_FILE_PHOTO, self::TYPE_FILE_SIMPLE])) {
            return function ($root) {
                $handle = function ($el) {
                    $result = $el;
                    if (is_numeric($el)) {
                        $result = AdminModule::getFileModel($el);
                    }

                    return $result;
                };
                $var = $root[$this->name];
                if ($var) {
                    if ($this->multiple) {
                        return array_map($handle, $var);
                    } else {
                        return $handle($var);
                    }
                }

                return null;
            };
        }

        return $result;
    }
}
