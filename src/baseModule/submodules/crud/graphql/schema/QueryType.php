<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 11:03
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema;


use GraphQL\Type\Definition\ObjectType;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'crud' => [
                        'type' => Types::crudElement(),
                        'resolve' => function ($root, $args, $context, $a) {
                            return true;
                        },
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
