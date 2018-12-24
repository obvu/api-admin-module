<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\models\element;


use Zvinger\BaseClasses\api\request\BaseApiRequest;

/**
 * Class BaseElementRequest
 * @package Obvu\Modules\Api\Admin\submodules\crud\models\element
 * @SWG\Definition()
 */
class BaseElementRequest extends BaseApiRequest
{
    /**
     * @var string
     * @SWG\Property()
     */
    public $type;
}
