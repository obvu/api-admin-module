<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\models\element\index;


/**
 * Class ElementListResponse
 * @package Obvu\Modules\Api\Admin\submodules\crud\models\element\index
 * @SWG\Definition()
 */
class ElementListResponse
{
    /**
     * @var mixed[]
     * @SWG\Property()
     */
    public $elements;

    /**
     * @var int
     * @SWG\Property()
     */
    public $totalCount;

    /**
     * @var string[]
     * @SWG\Property()
     */
    public $headers = [];
}
