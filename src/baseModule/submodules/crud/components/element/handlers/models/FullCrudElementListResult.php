<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models;


use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;

class FullCrudElementListResult
{
    /**
     * @var SingleCrudElementModel[]
     */
    public $elements;

    public $totalCount;

    public $headers = [];
}
