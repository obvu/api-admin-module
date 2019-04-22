<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\models\element\single;

use Obvu\Modules\Api\Admin\submodules\crud\models\element\BaseElementRequest;

/**
 * Class ElementListRequest
 * @package Obvu\Modules\Api\Admin\submodules\crud\models\element\single
 * @SWG\Definition()
 */
class ElementSingleRequest extends BaseElementRequest
{
    /**
     * @var int
     * @SWG\Property()
     */
    public $id;

    /**
     * @var string
     * @SWG\Property()
     */
    public $type;
}
