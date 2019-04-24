<?php
/**
 * Created by PhpStorm.
 * User: nik
 * Date: 23.04.19
 * Time: 9:50
 */

namespace Obvu\Modules\Api\Admin\submodules\userControl\graphql\types\user;


use app\models\work\user\object\UserObject;
use Obvu\Modules\Api\Admin\submodules\userControl\graphql\types\user\mainInfo\UserMainInfoType;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class UserInfoType extends BaseGraphQLObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'mainInfo' => [
                        'type' => UserMainInfoType::initType(),
                        'resolve' => function (UserObject $userObject, $args) {
                            return $userObject->getAttributes();
                        }
                    ],
                ];
            },
        ];

        parent::__construct($config);
    }
}
