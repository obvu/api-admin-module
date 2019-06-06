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
use Obvu\Modules\Api\Admin\submodules\userControl\graphql\mutations\UserMutationType;
use yii\web\BadRequestHttpException;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class UserInfoAdminMutationType extends BaseGraphQLObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'user' => [
                        'type' => UserMutationType::initType(),
                        'args' => [
                            'user_id' => Type::id(),
                        ],
                        'resolve' => function ($v, $args) {
                            $user = UserObject::find()->where(['id' => $args['user_id']])->one();
                            if (empty($user)) {
                                throw new BadRequestHttpException('Пользователя не существует');
                            }
                            return $user;
                        }
                    ],
                ];
            },
        ];

        parent::__construct($config);
    }
}
