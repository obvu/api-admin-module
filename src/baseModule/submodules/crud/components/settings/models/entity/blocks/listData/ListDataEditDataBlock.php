<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 25.02.2019
 * Time: 22:33
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\listData;


use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\base\BaseEditDataBlock;

class ListDataEditDataBlock extends BaseEditDataBlock
{
    public $fields = [];

    public $type = 'list_data_edit_data_block';

    public function init()
    {
        parent::init();
        $fullCrudModule = \Yii::$app->currentFullCrud;
        if ($this->fields === true) {
            if (!static::$inGettingData) {
                static::$inGettingData = true;
                $fullCrudModule->holdFormatting();
                $this->fields = $fullCrudModule->getCrudSettings()->findEntity($this->entityKey)->fields;
                $fullCrudModule->releaseFormatting();
            }
        }
        $fullCrudModule->getFieldHelper()->handleFields($this->entityKey, $this->fields);
    }
}
