<?php

namespace Obvu\Modules\Api\AdminSubmodules\Content\migrations;

use yii\db\Migration;

/**
 * Class M180507141401Text_blocks
 */
class M180507141401Text_blocks extends Migration
{
    private $textBlockTable = '{{%text_block}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = NULL;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable($this->textBlockTable, [
            'id'    => $this->primaryKey(),
            'key'   => $this->string(255),
            'type'  => $this->integer(),
            'title' => $this->string(255),
            'text'  => $this->text(),
        ], $tableOptions);

        $this->createIndex('index-text-block-key', $this->textBlockTable, 'key', TRUE);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->textBlockTable);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180507141401Text_blocks cannot be reverted.\n";

        return false;
    }
    */
}
