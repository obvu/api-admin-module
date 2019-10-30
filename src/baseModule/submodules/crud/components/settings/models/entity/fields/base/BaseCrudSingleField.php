<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 25.02.2019
 * Time: 22:27
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\base;


use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;

abstract class BaseCrudSingleField extends BaseObject
{
    const TYPE_INPUT_TEXT = 'input_text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_TEXT_EDITOR = 'textarea';
    const TYPE_SELECT = 'select';
    const TYPE_BOOLEAN_SELECT = 'boolean_select';
    const TYPE_DATE = 'input_date';
    const TYPE_FILE_PHOTO = 'file_photo';
    const TYPE_FILE_PHOTO_LARGE = 'file_photo_large';
    const TYPE_FILE_SIMPLE = 'file_photo';
    const TYPE_COLOR_PICKER = 'input_text';
//    const TYPE_COLOR_PICKER = 'input_colorpicker';

    public $type;

    public $name;

    public $label;

    public $defaultValue = null;

    /**
     * @var callable
     */
    public $beforeSendCallback;

    public function init()
    {
        parent::init();
        if (empty($this->label)) {
            $this->label = Inflector::camel2words($this->name, true);
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
            self::TYPE_FILE_PHOTO => Types::file(),
            self::TYPE_FILE_SIMPLE => Types::file(),
        ];

        return ArrayHelper::getValue($map, $this->type);
    }
}
