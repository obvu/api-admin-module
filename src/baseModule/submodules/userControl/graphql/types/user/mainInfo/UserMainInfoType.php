<?php
/**
 * Created by PhpStorm.
 * User: nik
 * Date: 23.04.19
 * Time: 9:50
 */

namespace Obvu\Modules\Api\Admin\submodules\userControl\graphql\types\user\mainInfo;


use GraphQL\Type\Definition\Type;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class UserMainInfoType extends BaseGraphQLObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'id' => Type::id(),
                    'username' => Type::string(),
                    'email' => Type::string(),
                    'status' => Type::int(),
                ];
            },
        ];

        parent::__construct($config);
    }
}
