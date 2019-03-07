<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 11:33
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementSingleResult;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;

class CrudBlockType extends ObjectType
{
    public function __construct($type)
    {
        $config = [
            'name' => 'block_type_'.$type,
            'fields' => function () use ($type) {
                $module = \Yii::$app->currentFullCrud;
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
                        'type' => Types::crudFullData($type),
                    ],
                ];
                if ($entity->hasSubEntity()) {
                    $arr['subEntity'] = [
                        'type' => Types::crudSubEntityData($type),
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
