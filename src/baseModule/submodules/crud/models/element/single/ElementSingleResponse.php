<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\models\element\single;


use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;
use Zvinger\BaseClasses\api\request\BaseApiRequest;

/**
 * Class ElementListResponse
 * @package Obvu\Modules\Api\Admin\submodules\crud\models\element\single
 * @SWG\Definition()
 */
class ElementSingleResponse extends BaseApiRequest
{
    /**
     * @var SingleCrudElementModel
     * @SWG\Property()
     */
    public $element;

    public static function createRequest($data = null)
    {
        /** @var self $data */
        $data =  parent::createRequest($data);
        $data->element = \Yii::configure(new SingleCrudElementModel(), $data->element);

        return $data;
    }


}
