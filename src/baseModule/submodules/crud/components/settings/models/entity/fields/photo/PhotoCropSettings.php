<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 26.04.2019
 * Time: 13:34
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\photo;


use yii\base\BaseObject;

class PhotoCropSettings extends BaseObject
{
    public $key;

    public $title;

    public $xMin;

    public $yMin;

    public $aspectRatio;

    public function init()
    {
        parent::init();
        if (empty($this->key)) {
            $this->key = 'ar_'.$this->aspectRatio;
        }
    }


}
