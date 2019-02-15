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
            'fields' => function () {
                return [
                    'fileId' => [
                        'type' => Type::string(),
                    ],
                    'fullUrl' => [
                        'type' => Type::string(),
                    ],
                ];
            },
        ];


        parent::__construct($config);
    }
}
