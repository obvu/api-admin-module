<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\settings\models;


use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\block\CrudSingleBlock;
use Obvu\Modules\Api\Admin\submodules\crud\components\settings\models\entity\CrudSingleEntity;

class FullCrudSettings
{
    public $title;

    public $entities;

    public $menu;

    /**
     * @var CrudSingleBlock[]
     */
    public $blocks;

    /**
     * @param $blockId
     * @return CrudSingleBlock
     */
    public function findBlock($blockId)
    {
        foreach ($this->blocks as $block) {
            if ($block->key === $blockId || $block->entityKey === $blockId) {
                return $block;
            }
        }
    }

    /**
     * @param $entityKey
     * @return CrudSingleEntity
     */
    public function findEntity($entityKey)
    {
        foreach ($this->entities as $block) {
            if ($block->key === $entityKey) {
                return $block;
            }
        }
    }
}
