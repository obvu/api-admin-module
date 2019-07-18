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
use Zvinger\BaseClasses\app\graphql\base\context\BaseGraphQLContext;

class UserInfoAdminQueryType extends BaseGraphQLObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'user' => [
                        'type' => UserInfoType::initType(),
                        'resolve' => function ($v, $args, BaseGraphQLContext $context) {
                            return UserObject::find()->where(['id' => $context->getIdentity()->getId()])->one();
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
