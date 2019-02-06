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
                    $resultFields[$crudSingleBlock->entityKey] = [
                        'type' => Types::crudBlock($crudSingleBlock->entityKey),
                        'args' => [
                            'id' => Type::string(),
                        ],
                        'resolve' => function ($root, $args) use ($crudSingleBlock, $fullCrud) {
                            $type = $crudSingleBlock->entityKey;
                            $id = $args['id'];
                            if (empty($id)) {
                                if ($crudSingleBlock->type == $crudSingleBlock::TYPE_SINGLE) {
                                    $id = '0';
                                } else {
                                    throw new BadRequestHttpException("Id is needed");
                                }
                            }
                            $element = \Yii::$app->currentFullCrud->getElementComponent()->singleElement(
                                \Yii::createObject(
                                    [
                                        'class' => ElementSingleRequest::class,
                                        'type' => $type,
                                        'id' => $id,
                                    ]
                                )
                            )->element;

                            return $element;
                        },
                    ];
                }

                return $resultFields;
            },
        ];

        parent::__construct($config);
    }
}
