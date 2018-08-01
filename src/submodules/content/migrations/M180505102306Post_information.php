<?php

namespace Obvu\Modules\Api\AdminSubmodules\Content\migrations;

use yii\db\Migration;

/**
 * Class M180505102306Post_information
 */
class M180505102306Post_information extends Migration
{
    private $postTable = '{{%post}}';

    private $postCategoryTable = '{{%post_category}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = NULL;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $postTable = $this->postTable;
        $this->createTable($postTable, [
            'id'          => $this->primaryKey(),
            'category_id' => $this->integer(),
            'slug'        => $this->string(30),
            'title'       => $this->string(255),
            'text'        => $this->text(),

            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        $postCategoryTable = $this->postCategoryTable;
        $this->createTable($postCategoryTable, [
            'id'          => $this->primaryKey(),
            'slug'        => $this->string(30),
            'title'       => $this->string(255),
            'description' => $this->text(),
        ], $tableOptions);

        $this->addForeignKey('FK_' . 'post' . '_created_by', 'post', 'created_by', '{{%user}}', 'id', 'set null', 'cascade');
        $this->addForeignKey('FK_' . 'post' . '_category_id', 'post', 'category_id', $postCategoryTable, 'id', 'set null', 'cascade');
        $this->createIndex('INDEX_' . 'post' . '_category_id', 'post', 'category_id');
        $this->createIndex('INDEX_' . 'post' . '_slug', 'post', 'slug');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_' . 'post' . '_created_by', 'post');
        $this->dropForeignKey('FK_' . 'post' . '_category_id', 'post');
        $this->dropTable($this->postTable);
        $this->dropTable($this->postCategoryTable);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180505102306Post_information cannot be reverted.\n";

        return false;
    }
    */
}
