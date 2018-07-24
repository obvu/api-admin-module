<?php

namespace Obvu\Modules\Api\AdminSubmodules\Crud\migrations;

use yii\db\Migration;

/**
 * Class M180609084950CrudSOrt
 */
class M180609084950CrudSOrt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%crud_element_table}}', 'sort', 'int');
        $this->createIndex('crud_sort_index', '{{%crud_element_table}}', 'sort');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%crud_element_table}}', 'sort');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180609084950CrudSOrt cannot be reverted.\n";

        return false;
    }
    */
}
