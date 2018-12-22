<?php

namespace Obvu\Modules\Api\Admin\submodules\crud\migrations;

use yii\db\Migration;

/**
 * Class M180524070109CrudElement
 */
class M180524070109CrudElement extends Migration
{
    public $elementTableName;

    public $elementTable;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->elementTableName = 'full_crud_element_table';
        $this->elementTable = '{{%'.$this->elementTableName.'}}';
    }


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            $this->elementTable,
            [
                'id' => $this->primaryKey(),
                'module' => $this->string(),
                'type' => $this->string(255),
                'data_id' => $this->string(255),
                'data' => $this->json(),
                'sort' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex(
            'INDEX_'.$this->elementTableName.'_type',
            $this->elementTable,
            ['module', 'type', 'data_id'],
            true
        );

        $this->createIndex('crud_sort_index', $this->elementTable, 'sort');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->elementTable);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180524070109CrudElement cannot be reverted.\n";

        return false;
    }
    */
}
