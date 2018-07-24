<?php

namespace Obvu\Modules\Api\AdminSubmodules\Crud\components\database\models\crud\element;

use Yii;

/**
 * This is the model class for table "crud_element_table".
 *
 * @property int $id
 * @property string $type
 * @property string $data_id
 * @property string $data
 * @property int $sort
 */
class DBCrudElementObject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'crud_element_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['sort'], 'integer'],
            [['type', 'data_id'], 'string', 'max' => 255],
            [['type', 'data_id'], 'unique', 'targetAttribute' => ['type', 'data_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'data_id' => 'Data ID',
            'data' => 'Data',
            'sort' => 'Sort',
        ];
    }
}
