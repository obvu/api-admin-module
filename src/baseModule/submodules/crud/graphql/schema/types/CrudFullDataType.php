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
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use yii\web\NotFoundHttpException;

class CrudFullDataType extends ObjectType
{
    public function __construct($type)
    {
        $config = [
            'name' => 'full_data_'.$type,
            'fields' => function () use ($type) {
                $module = \Yii::$app->currentFullCrud;
                $settings = $module->getCrudSettings();
                $entity = $settings->findEntity($type);
                if (empty($entity)) {
                    throw new NotFoundHttpException("No such entity");
                }
                $resultFields = [];
                foreach ($entity->fields as $field) {
                    if (isset($field->name)) {
                        $resultFields[$field->name] = [
                            'type' => $field->getGraphQLFieldType(),
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
