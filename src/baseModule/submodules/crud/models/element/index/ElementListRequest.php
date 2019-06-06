<?php

namespace Obvu\Modules\Api\Admin\submodules\crud\models\element\index;

use Obvu\Modules\Api\Admin\submodules\crud\models\element\BaseElementRequest;

/**
 * Class ElementListRequest
 * @package Obvu\Modules\Api\Admin\submodules\crud\models\element\index
 * @SWG\Definition()
 */
class ElementListRequest extends BaseElementRequest
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
     * @var ElementListFilter
     * @SWG\Property()
     */
    public $filter;

    /**
     * @var string
     * @SWG\Property()
     */
    public $sortBy = null;

    /**
     * @var object
     * @SWG\Property()
     */
    public $filterData;

    public $searchQuery;
}
