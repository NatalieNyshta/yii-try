<?php

use console\migrations\CustomMigration;
use yii\db\Schema;

class m160920_183453_init_customer_table extends CustomMigration
{
    public function up()
    {
        $this->createTable(
            'customer',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING,
                'birth_date' => Schema::TYPE_DATE,
                'notes' => Schema::TYPE_TEXT,
            ],
            $this->defaultTableOptions()
        );
    }

    public function down()
    {
        $this->dropTable('customer');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
