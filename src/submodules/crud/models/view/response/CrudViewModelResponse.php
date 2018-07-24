<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 24.05.18
 * Time: 8:25
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\models\view\response;

use yii\base\BaseObject;

/**
 * Class CrudViewModelResponse
 * @package ObvuCrudModule\models\view\response
 * @SWG\Definition()
 */
class CrudViewModelResponse extends BaseObject
{
    /**
     * @var string
     * @SWG\Property()
     */
    public $type;

    /**
     * @var int
     * @SWG\Property()
     */
    public $dataId;

    /**
     * @var string
     * @SWG\Property()
     */
    public $dataTitle;

    /**
     * @var object
     * @SWG\Property()
     */
    public $data;

    private $_object;

    /**
     * @param mixed $object
     */
    public function setObject($object): void
    {
        $this->_object = $object;
    }
}