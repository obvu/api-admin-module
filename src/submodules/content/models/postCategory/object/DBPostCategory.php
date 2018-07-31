<?php

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory\object;

/**
 * This is the model class for table "post_category".
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $description
 */
class DBPostCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['slug'], 'string', 'max' => 30],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'slug'        => 'Slug',
            'title'       => 'Title',
            'description' => 'Description',
        ];
    }
}
