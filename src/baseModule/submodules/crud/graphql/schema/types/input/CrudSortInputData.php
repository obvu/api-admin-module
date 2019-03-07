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

class CrudSortInputData extends InputObjectType
{
    public function __construct($type)
    {
        $config = [
            'name' => 'sort_data'.$type,
            'fields' => function () use ($type) {
                $module = \Yii::$app->currentFullCrud;
                $settings = $module->getCrudSettings();
                $entity = $settings->findEntity($type);
                if (empty($entity)) {
                    return [];
                }
                $resultFields = [];
                foreach ($entity->fields as $field) {
                    if (!($field instanceof BaseCrudSingleField)) continue;
                    if (isset($field->name)) {
                        $graphQLFieldType = $field->getGraphQLFieldType();
                        if (!in_array($graphQLFieldType, [Type::string()])) continue;
                        $resultFields[$field->name] = [
                            'type' => Type::string(),
                            'description' => $field->label,
                        ];
                    }
                }

                return $resultFields;
            },
        ];

        parent::__construct($config);
    }

}
