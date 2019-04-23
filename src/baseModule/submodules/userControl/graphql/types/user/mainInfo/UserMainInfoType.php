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
use Zvinger\BaseClasses\app\helpers\fakeData\DataFakerGenerator;

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
                    'fullName' => [
                        'type' => Type::string(),
                        'resolve' => function () {
                            return DataFakerGenerator::go()->name;
                        }
                    ],
                ];
            },
        ];

        parent::__construct($config);
    }
}
