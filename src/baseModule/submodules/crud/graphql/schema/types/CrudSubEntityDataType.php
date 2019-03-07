<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 01.03.2019
 * Time: 11:32
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\blocks\base\BaseEditDataBlock;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use yii\web\NotFoundHttpException;

class CrudSubEntityDataType extends ObjectType
{
    public function __construct($type)
    {
        $config = [
            'name' => 'sub_entity_'.$type,

            'fields' => function () use ($type) {
                $module = \Yii::$app->currentFullCrud;
                $settings = $module->getCrudSettings();
                $entity = $settings->findEntity($type);
                $resultFields = [];
                if (empty($entity)) {
                    throw new NotFoundHttpException("No such entity");
                }
                foreach ($entity->fields as $field) {
                    if (!($field instanceof BaseEditDataBlock)) {
                        continue;
                    }

                    $resultFields[$field->name] = [
                        'type' => Type::listOf(Types::crudBlock($field->entityKey)),
                        'description' => $field->title,
                        'args' => [
                            'fullData' => Types::inputFullData($field->entityKey),
                        ],
                        'resolve' => function ($el, $args) use ($field) {
                            $result = $el->{$field->name};
                            if (is_callable($result)) {
                                $result = ($result)($args);
                            }

                            return $result;
                        },
                    ];
                }

                return $resultFields;
            },
        ];

        parent::__construct($config);
    }
}
