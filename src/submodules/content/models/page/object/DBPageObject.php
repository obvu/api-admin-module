<?php

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\page\object;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $title
 * @property string $page_data
 * @property int $template_id
 * @property string $slug
 * @property int $status
 * @property int $publish_at
 */
class DBPageObject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_data'], 'string'],
            [['template_id', 'status', 'publish_at'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'title'       => 'Title',
            'page_data'   => 'Page Data',
            'template_id' => 'Template ID',
            'slug'        => 'Slug',
            'status'      => 'Status',
            'publish_at'  => 'Publish At',
        ];
    }
}
