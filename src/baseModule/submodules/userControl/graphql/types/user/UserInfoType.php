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
use Obvu\Modules\Api\Admin\submodules\userControl\UserControlModule;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class UserInfoType extends BaseGraphQLObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                $fields = [
                    'mainInfo' => [
                        'type' => UserMainInfoType::initType(),
                        'resolve' => function (UserObject $userObject) {
                            return $userObject->getAttributes();
                        }
                    ],
                ];

                if ($UserAdditionalInfoType = UserControlModule::getGraphQLObjectType('UserAdditionalInfoType')) {
                    $fields['additionalInfo'] = $UserAdditionalInfoType;
                }
                return $fields;
            },
        ];

        parent::__construct($config);
    }
}
