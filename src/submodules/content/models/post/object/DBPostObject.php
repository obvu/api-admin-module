<?php

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\post\object;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $category_id
 * @property string $slug
 * @property string $title
 * @property string $text
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 */
class DBPostObject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'created_at', 'created_by', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [['slug'], 'string', 'max' => 30],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\components\database\repository\post\models\category\DBPostCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => \Zvinger\BaseClasses\app\models\work\user\object\VendorUserObject::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'category_id' => 'Category ID',
            'slug'        => 'Slug',
            'title'       => 'Title',
            'text'        => 'Text',
            'created_at'  => 'Created At',
            'created_by'  => 'Created By',
            'updated_at'  => 'Updated At',
        ];
    }
}
