<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 11:33
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementSingleResult;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;
use Zvinger\BaseClasses\app\graphql\base\types\KeyValueGraphQLType;

class CrudBlockType extends BaseGraphQLObjectType
{
    public function __construct($type, FullCrudModule $module = null)
    {
        $config = [
            'name' => 'block_type_'.$type,
            'fields' => function () use ($type, $module) {
                $settings = $module->getCrudSettings();
                $entity = $settings->findEntity($type);

                $arr = [
                    'id' => [
                        'type' => Type::string(),
                    ],
                    'type' => [
                        'type' => Type::string(),
                    ],
                    'fullData' => [
                        'type' => CrudFullDataType::initType([$type, $module]),
                    ],
                    'elementMiscData' => [
                        'type' => Type::listOf(KeyValueGraphQLType::initType()),
                    ],
                ];
                if ($entity->hasSubEntity()) {
                    $arr['subEntity'] = [
                        'type' => CrudSubEntityDataType::initType([$type, $module]),
                        'resolve' => function (SingleCrudElementModel $el) {
                            $prepareSubEntity = $el->prepareSubEntity();

                            return $prepareSubEntity->subEntity;
                        },
                    ];
                }

                return $arr;
            },
        ];


        parent::__construct($config);
    }

}
