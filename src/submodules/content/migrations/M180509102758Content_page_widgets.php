<?php

namespace Obvu\Modules\Api\AdminSubmodules\Content\migrations;

use yii\db\Migration;

/**
 * Class M180509102758Content_page_widgets
 */
class M180509102758Content_page_widgets extends Migration
{
    public $pageTable = '{{%page}}';

    public $widgetTable = '{{%widget}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = NULL;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable($this->pageTable, [
            'id'          => $this->primaryKey(),
            'title'       => $this->string(255),
            'page_data'   => $this->text(),
            'template_id' => $this->integer(),
            'slug'        => $this->string(255),
            'status'      => $this->tinyInteger(),
            'publish_at'  => $this->integer(),
        ], $tableOptions);


        $this->createTable($this->widgetTable, [
            'id'    => $this->primaryKey(),
            'key'   => $this->string(255),
            'value' => $this->text(),
        ], $tableOptions);

        $this->createIndex('index-page-slug', $this->pageTable, 'slug', TRUE);
        $this->createIndex('index-page-publish-at', $this->pageTable, 'publish_at');
        $this->createIndex('index-widget-key', $this->widgetTable, 'key');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->pageTable);
        $this->dropTable($this->widgetTable);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180509102758Content_page_widgets cannot be reverted.\n";

        return false;
    }
    */
}
