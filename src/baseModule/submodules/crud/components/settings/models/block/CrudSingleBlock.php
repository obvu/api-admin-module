<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\block;


use yii\base\BaseObject;

class CrudSingleBlock extends BaseObject
{
    const TYPE_CRUD = 'crud';
    const TYPE_SINGLE = 'single';

    public $entityKey;

    public $type;

    public $key;

    public $tableFields;

    public function init()
    {
        $this->key = (!$this->key && $this->entityKey) ? $this->entityKey : $this->key;
    }
}
