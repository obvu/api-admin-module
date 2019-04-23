<?php
/**
 * Created by PhpStorm.
 * User: nik
 * Date: 23.04.19
 * Time: 14:48
 */

namespace Obvu\Modules\Api\Admin\submodules\userControl\graphql\mutations;


use app\models\work\user\object\UserObject;
use GraphQL\Type\Definition\Type;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class UserMutationType extends BaseGraphQLObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'changeUserMainInfo' => [
                        'type' => Type::boolean(),
                        'args' => [
                            'username' => Type::string(),
                            'email' => Type::string(),
                            'status' => Type::int(),
                        ],
                        'resolve' => function (UserObject $userObject, $args) {
                            $userObject->setAttributes($args);
                            return $userObject->save();
                        }
                    ],
                ];
            },
        ];

        parent::__construct($config);
    }
}
