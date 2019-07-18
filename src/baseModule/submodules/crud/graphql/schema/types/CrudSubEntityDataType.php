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
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\input\CrudFullDataInputData;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\input\CrudSortInputData;
use yii\web\NotFoundHttpException;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;
use Zvinger\BaseClasses\app\graphql\base\types\input\PaginationInputType;

class CrudSubEntityDataType extends BaseGraphQLObjectType
{
    public function __construct($type, FullCrudModule $module)
    {
        $config = [
            'name' => 'sub_entity_'.$type,

            'fields' => function () use ($type, $module) {
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
                        'type' => Type::listOf(
                            CrudBlockType::initType([$field->entityKey, $module])
                        ),
                        'description' => $field->title,
                        'args' => [
                            'fullData' => CrudFullDataInputData::initType(
                                [$field->entityKey, $module]
                            ),
                            'sortData' => CrudSortInputData::initType([$field->entityKey, $module]),
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
