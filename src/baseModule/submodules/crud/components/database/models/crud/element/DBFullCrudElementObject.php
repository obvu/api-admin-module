<?php

namespace Obvu\Modules\Api\Admin\submodules\crud\components\database\models\crud\element;

use Yii;

/**
 * This is the model class for table "full_crud_element_table".
 *
 * @property int $id
 * @property string $module
 * @property string $type
 * @property array $data
 * @property int $sort
 */
class DBFullCrudElementObject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'full_crud_element_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data'], 'safe'],
            [['sort'], 'integer'],
            [['module', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module' => 'Module',
            'type' => 'Type',
            'data' => 'Data',
            'sort' => 'Sort',
        ];
    }
}
