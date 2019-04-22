<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models;

use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;

/**
 * Class FullCrudElementSingleResult
 * @package Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models
 * @SWG\Definition()
 */
class FullCrudElementSingleResult
{
    /**
     * @var SingleCrudElementModel
     * @SWG\Property()
     */
    public $element;
}
