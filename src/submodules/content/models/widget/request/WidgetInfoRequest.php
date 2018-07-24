<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:08
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\widget\request;


use Obvu\Modules\Api\AdminSubmodules\Content\models\widget\WidgetsInfo;
use Zvinger\BaseClasses\api\request\BaseApiRequest;

/**
 * Class PostInfoRequest
 * @package Obvu\Modules\Api\AdminSubmodules\Content\models\widget\request
 * @SWG\Definition()
 */
class WidgetInfoRequest extends BaseApiRequest
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