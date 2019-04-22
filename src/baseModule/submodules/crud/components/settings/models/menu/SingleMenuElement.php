<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\menu;


use yii\base\BaseObject;

class SingleMenuElement extends BaseObject
{
    public $blockKey;

    public $title;

    /**
     * @var self[]
     */
    public $children = [];
}
