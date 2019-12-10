<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 10.12.2019
 * Time: 11:17
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\crud\banner;


use GraphQL\Type\Definition\Type;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class CrudBannerSlideType extends BaseGraphQLObjectType
{
    public function __construct()
    {
        $config = [
//            'name' => 'file_1',
            'fields' => function () {
                return [
                    'subtitle' => Type::string(),
                    'title' => Type::string(),
                    'title1' => Type::string(),
                    'title2' => Type::string(),
                    'type' => Type::int(),
                    'fixedSize' => Type::boolean(),
                    'bigFont' => Type::boolean(),
                    'typeData' => CrudBannerTypeDataElement::initType(),
                ];
            },
        ];


        parent::__construct($config);
    }
}
