<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 12.05.18
 * Time: 7:33
 */

namespace Obvu\Modules\Api\Admin\submodules\content\models\widget;


/**
 * Class WidgetsInfo
 * @package Obvu\Modules\Api\Admin\submodules\content\models\widget
 * @SWG\Definition()
 */
class WidgetsInfo
{
    /**
     * Код в верхнем блоке
     * @var string
     * @SWG\Property()
     */
    public $topCode;

    /**
     * Код в нижнем блоке
     * @var string
     * @SWG\Property()
     */
    public $bottomCode;
}