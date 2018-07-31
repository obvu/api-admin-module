<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 13:31
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\post\object;

use Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory\object\PostCategory;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class PostObject extends DBPostObject
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class'              => BlameableBehavior::class,
                'updatedByAttribute' => FALSE,
            ],
        ];
    }

    public function getPostCategory()
    {
        return $this->hasOne(PostCategory::class, [
            'id' => 'category_id',
        ]);
    }

    /**
     * @return PostQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return new PostQuery(static::class);
    }


}