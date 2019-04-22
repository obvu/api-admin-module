<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 11:43
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\base\BaseCrudSingleField;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use yii\web\NotFoundHttpException;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class CrudFullDataType extends BaseGraphQLObjectType
{
    public function __construct($type, FullCrudModule $module = null)
    {
        $config = [
            'name' => 'full_data_'.$type,
            'fields' => function () use ($type, $module) {
                $settings = $module->getCrudSettings();
                $entity = $settings->findEntity($type);
                if (empty($entity)) {
                    throw new NotFoundHttpException("No such entity");
                }
                $resultFields = [];
                foreach ($entity->fields as $field) {
                    if (!($field instanceof BaseCrudSingleField)) continue;
                    if (isset($field->name)) {
                        $resultFields[$field->name] = [
                            'type' => $field->getGraphQLFieldType(),
                            'description' => $field->label,
                        ];
                        if (is_callable($field->getResolveFn())) {
                            $resultFields[$field->name]['resolve'] = $field->getResolveFn();
                        }
                    }
                }

                return $resultFields;
            },
        ];

        parent::__construct($config);
    }

}
