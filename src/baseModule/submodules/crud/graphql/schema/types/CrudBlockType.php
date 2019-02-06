<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 11:33
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types;


use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CrudBlockType extends ObjectType
{
    public function __construct($type)
    {
        $config = [
            'fields' => function () use ($type) {
                return [
                    'id' => [
                        'type' => Type::string(),
                    ],
                    'type' => [
                        'type' => Type::string(),
                    ],
                    'fullData' => [
                        'type' => Types::crudFullData($type),
                        'resolve' => function ($el) {
                    d($el);die;
                        }
                    ],
                ];
            },
        ];


        parent::__construct($config);
    }

}
