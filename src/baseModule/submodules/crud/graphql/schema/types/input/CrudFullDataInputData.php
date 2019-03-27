<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.03.2019
 * Time: 11:39
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\input;


use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\fields\base\BaseCrudSingleField;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use Zvinger\BaseClasses\app\graphql\base\types\input\BaseGraphQLInputType;

class CrudFullDataInputData extends BaseGraphQLInputType
{
    public function __construct($type, FullCrudModule $module)
    {
        $config = [
            'name' => 'input_data_'.$type,
            'fields' => function () use ($type, $module) {
                $settings = $module->getCrudSettings();
                $entity = $settings->findEntity($type);
                if (empty($entity)) {
                    return [];
                }
                $resultFields = [];
                foreach ($entity->fields as $field) {
                    if (!($field instanceof BaseCrudSingleField)) {
                        continue;
                    }
                    if (isset($field->name)) {
                        $graphQLFieldType = $field->getGraphQLFieldType();
                        if (!in_array($graphQLFieldType, [Type::string()])) {
                            continue;
                        }
                        $resultFields[$field->name] = [
                            'type' => $graphQLFieldType,
                            'description' => $field->label,
//                            'resolve' => function ($e) use ($field) {
//                            d([$e, $field->name]);die;
//                            }
                        ];
                    }
                }

                return $resultFields;
            },
        ];

        parent::__construct($config);
    }

}
