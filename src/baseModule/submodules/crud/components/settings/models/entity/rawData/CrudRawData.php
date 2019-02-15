<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 13.02.2019
 * Time: 18:05
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\rawData;


use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;
use yii\base\BaseObject;

class CrudRawData extends BaseObject
{
    const TYPE_SIMPLE_TEXT = 'type_simple_text';

    public $label;

    public $type;

    public $name;

    private $data;

    /**
     * @var SingleCrudElementModel
     */
    private $entity;

    /**
     * @var callable
     */
    public $resolve = null;

    public function getData()
    {
        if (!$this->data && $this->resolve) {
            $this->data = call_user_func($this->resolve, $this);
        }

        return [
            'label' => $this->label,
            'name' => $this->name,
            'value' => $this->data,
        ];
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @param SingleCrudElementModel $entity
     * @return CrudRawData
     */
    public function setEntity(SingleCrudElementModel $entity): CrudRawData
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @return SingleCrudElementModel
     */
    public function getEntity(): SingleCrudElementModel
    {
        return $this->entity;
    }
}
