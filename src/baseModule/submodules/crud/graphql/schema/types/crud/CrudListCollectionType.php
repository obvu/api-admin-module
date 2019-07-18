<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 01.04.2019
 * Time: 13:50
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\crud;


use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\block\CrudSingleBlock;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\CrudBlockType;
use Zvinger\BaseClasses\app\graphql\base\BaseGraphQLObjectType;

class CrudListCollectionType extends BaseGraphQLObjectType
{
    public function __construct(CrudSingleBlock $crudSingleBlock, $module)
    {
        $crudBlockType = CrudBlockType::initType([$crudSingleBlock->entityKey, $module]);
        $key = 'element';
        if ($crudSingleBlock->type == $crudSingleBlock::TYPE_CRUD) {
            $crudBlockType = Type::listOf($crudBlockType);
            $key = 'elements';
        }
        $fields = [
            $key => $crudBlockType,
        ];
        if ($key === 'elements') {
            $fields['totalCount'] = Type::int();
        }
        $config = [
            'name' => 'crud_list_collection__'.$crudSingleBlock->entityKey,
            'fields' => $fields,
        ];
        parent::__construct($config);
    }

}
