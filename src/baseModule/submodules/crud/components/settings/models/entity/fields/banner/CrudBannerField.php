<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 13.11.2019
 * Time: 14:00
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\banner;


use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\CrudSingleField;

class CrudBannerField extends CrudSingleField
{
    public $type = self::TYPE_BANNER_CONTROL;

    public $imageControl;
}
