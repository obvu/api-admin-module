<?php
/**
 * Created by PhpStorm.
 * User: nik
 * Date: 23.04.19
 * Time: 9:47
 */

namespace Obvu\Modules\Api\Admin\submodules\userControl\graphql;


use app\models\work\user\object\UserObject;
use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\userControl\graphql\types\user\UserInfoType;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class UserInfoAdminQueryType extends BaseGraphQLObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'user' => [
                        'type' => UserInfoType::initType(),
                        'args' => [
                            'user_id' => Type::id(),
                        ],
                        'resolve' => function ($v, $args) {
                            return UserObject::find()->where(['id' => $args['user_id']])->one();
                        }
                    ],
                    'userList' => [
                        'type' => Type::listOf(UserInfoType::initType()),
                        'resolve' => function () {
                            return UserObject::find()->asArray()->all();
                        }
                    ]
                ];
            },
        ];

        parent::__construct($config);
    }

}
