<?php

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\object;

use Yii;

/**
 * This is the model class for table "text_block".
 *
 * @property int $id
 * @property string $key
 * @property int $type
 * @property string $title
 * @property string $text
 */
class DBTextBlock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'text_block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['text'], 'string'],
            [['key', 'title'], 'string', 'max' => 255],
            [['key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'type' => 'Type',
            'title' => 'Title',
            'text' => 'Text',
        ];
    }
}
