<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 15.02.2019
 * Time: 14:39
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\base;


use yii\base\BaseObject;

abstract class BaseEditDataBlock extends BaseObject
{
    public $type;

    public $title;

    public $parentElementKey;

    public $name = null;

    public $entityKey;

    public $notGroup = false;

    public $hide = true;

    protected static $inGettingData = false;

    public function init()
    {
        parent::init();
        if (empty($this->name)) {
            $this->notGroup = true;
            $this->name = $this->entityKey;
        }
    }
}
