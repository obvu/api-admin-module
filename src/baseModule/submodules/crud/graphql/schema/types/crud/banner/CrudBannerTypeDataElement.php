<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 10.12.2019
 * Time: 11:21
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\crud\banner;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class CrudBannerTypeDataElement extends BaseGraphQLObjectType
{
    public function __construct()
    {
        $config = [
//            'name' => 'file_1',
            'fields' => function () {
                return [
                    'photo' => new ObjectType(
                        [
                            'name' => "photo_type",
                            'fields' => [
                                'file' => Types::file(),
                            ],
                        ]
                    ),
                ];
            },
        ];


        parent::__construct($config);
    }
}
