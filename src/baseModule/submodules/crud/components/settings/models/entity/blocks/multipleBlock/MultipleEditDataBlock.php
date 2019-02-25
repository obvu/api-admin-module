<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 15.02.2019
 * Time: 14:39
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\multipleBlock;


use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\base\BaseEditDataBlock;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\CrudSingleField;

class MultipleEditDataBlock extends BaseEditDataBlock
{
    public $entityKey;

    public $title;


    public $type = 'multiple-fields-block';

    public $parentElementKey;

    /**
     * @var CrudSingleField[]
     */
    public $fieldsLeft = [];

    /**
     * @var CrudSingleField[]
     */
    public $fieldsRight = [];
}
