<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 11:05
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types;


use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListRequest;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\single\ElementSingleRequest;
use yii\web\BadRequestHttpException;

class CrudElementType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                $fullCrud = \Yii::$app->currentFullCrud;
                $resultFields = [];
                foreach ($fullCrud->getCrudSettings()->blocks as $crudSingleBlock) {
                    $crudBlockType = Types::crudBlock($crudSingleBlock->entityKey);
                    if ($crudSingleBlock->type == $crudSingleBlock::TYPE_CRUD) {
                        $crudBlockType = Type::listOf($crudBlockType);
                    }
                    $resultFields[$crudSingleBlock->entityKey] = [
                        'type' => $crudBlockType,
                        'args' => [
                            'id' => Type::string(),
                        ],
                        'resolve' => function ($root, $args) use ($crudSingleBlock, $fullCrud) {
                            $type = $crudSingleBlock->entityKey;
                            $id = $args['id'];
                            if ($crudSingleBlock->type == $crudSingleBlock::TYPE_SINGLE) {
                                $id = '0';
                            }
                            if ($crudSingleBlock->type == $crudSingleBlock::TYPE_SINGLE) {
                                $request = \Yii::createObject(
                                    [
                                        'class' => ElementSingleRequest::class,
                                        'type' => $type,
                                        'id' => $id,
                                    ]
                                );
                                $singleCrudElementModel = \Yii::$app->currentFullCrud->getElementComponent(
                                )->singleElement(
                                    $request
                                );

                                $result = $singleCrudElementModel ? $singleCrudElementModel->element : null;
                                if ($crudSingleBlock->type == $crudSingleBlock::TYPE_CRUD) {
                                    $result = [$result];
                                }
                            } else {

                                $elementListFilter = \Yii::$app->currentFullCrud->getElementComponent(
                                )->buildFilterFromGraphQLArgs($type, $args);
//                                d($elementListFilter);die;
                                $result = \Yii::$app->currentFullCrud->getElementComponent()->listElement(
                                    \Yii::createObject(
                                        [
                                            'class' => ElementListRequest::class,
                                            'type' => $type,
                                            'filter' => $elementListFilter
                                        ]
                                    )
                                )->elements;
                            }

                            return $result;
                        },
                    ];
                };

                return $resultFields;
            },
        ];

        parent::__construct($config);
    }
}
