<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 04.03.2019
 * Time: 16:55
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\helpers;


use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\CrudSingleEntity;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;

class FieldCollectorHelper
{
    /**
     * @var FullCrudModule
     */
    protected $fullCrudModule;

    public function __construct(FullCrudModule $fullCrudModule)
    {
        $this->fullCrudModule = $fullCrudModule;
    }

    public function handleField($entityKey, $field)
    {
        d(1);
        die;
    }

    /**
     * @param string|CrudSingleEntity $entity
     * @param array $fields
     */
    public function handleFields($entity, &$fields = [])
    {
        if (!$this->fullCrudModule->getElementComponent()->isBlocked('fieldCollector')) {
            $this->fullCrudModule->getElementComponent()->holdBlock('fieldCollector');
            foreach ($fields as $key => $field) {
                if (is_string($field)) {
                    if (is_string($entity)) {
                        $fullCrudSettings = $this->fullCrudModule->getCrudSettings();
                        $entity = $fullCrudSettings->findEntity($entity);
                    }
                    $field = $entity->findField($field);
                    $fields[$key] = $field;
                }
            }
            $this->fullCrudModule->getElementComponent()->releaseBlock('fieldCollector');
        }
    }
}
