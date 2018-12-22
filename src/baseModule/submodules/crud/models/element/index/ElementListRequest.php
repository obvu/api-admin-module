<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\models\element\index;


use Zvinger\BaseClasses\api\request\BaseApiRequest;

/**
 * Class ElementListRequest
 * @package Obvu\Modules\Api\Admin\submodules\crud\models\element\index
 * @SWG\Definition()
 */
class ElementListRequest extends BaseApiRequest
{
    /**
     * @var int
     * @SWG\Property()
     */
    public $page = 1;

    /**
     * @var int
     * @SWG\Property()
     */
    public $perPage = 20;

    /**
     * @var mixed
     * @SWG\Property()
     */
    public $filter;

    /**
     * @var string
     * @SWG\Property()
     */
    public $type;
}
