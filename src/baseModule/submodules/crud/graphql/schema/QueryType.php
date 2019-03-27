<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 11:03
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema;


use Obvu\Modules\Api\Admin\submodules\crud\FullCrudModule;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\CrudElementType;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class QueryType extends BaseGraphQLObjectType
{
    public function __construct(FullCrudModule $module = null)
    {
        $config = [
            'fields' => function() use ($module) {
                return [
                    'crud' => [
                        'type' => CrudElementType::initType([$module]),
                        'resolve' => function ($root, $args, $context, $a) {
                            return true;
                        },
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
