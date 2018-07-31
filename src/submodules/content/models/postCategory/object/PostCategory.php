<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 13:32
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory\object;

use app\components\database\repository\post\models\object\PostObject;

class PostCategory extends DBPostCategory
{
    public function getPostObjects()
    {
        return $this->hasMany(PostObject::class, [
            'category_id' => 'id',
        ]);
    }
}