<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 12:15
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\crud;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CrudFieldFileType extends ObjectType
{
    public function __construct()
    {
        $config = [
//            'name' => 'file_1',
            'fields' => function () {
                return [
                    'fileId' => [
                        'type' => Type::string(),

                    ],
                    'fullUrl' => [
                        'type' => Type::string(),
                    ],
                    'cropData' => [
                        'resolve' => function ($root) {
                            $result = [];
                            foreach ((array)$root['cropData'] as $type => $data) {
                                $element = $data;
                                $element['type'] = $type;
                                $result[] = $element;
                            }

                            return $result;
                        },
                        'type' => Type::listOf(
                            new ObjectType(
                                [
                                    'name' => 'file_crop_data',
                                    'fields' => [
                                        'type' => Type::string(),
                                        'height' => Type::float(),
                                        'rotate' => Type::float(),
                                        'scaleX' => Type::float(),
                                        'scaleY' => Type::float(),
                                        'width' => Type::float(),
                                        'x' => Type::float(),
                                        'y' => Type::float(),
                                    ],
                                ]
                            )
                        ),
                    ],
                ];
            },
        ];


        parent::__construct($config);
    }
}
