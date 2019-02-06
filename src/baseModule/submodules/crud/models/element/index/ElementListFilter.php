<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 09.01.2019
 * Time: 12:37
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\models\element\index;

/**
 * Class ElementListFilter
 * @package Obvu\Modules\Api\Admin\submodules\crud\models\element\index
 * @SWG\Definition()
 */
class ElementListFilter
{
    /**
     * @var null
     * @SWG\Property()
     */
    public $filterCallBack = null;

    public $conditions = [];

    public $orderBy = null;
}
