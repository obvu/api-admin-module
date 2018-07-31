<?php

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\widget\object;

/**
 * This is the model class for table "widget".
 *
 * @property int $id
 * @property string $key
 * @property string $value
 */
class DBWidgetObject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'key'   => 'Key',
            'value' => 'Value',
        ];
    }
}
