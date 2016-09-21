<?php

use console\migrations\CustomMigration;

class m160920_184833_init_phone_table extends CustomMigration
{
    public function up()
    {
        $this->createTable(
            'phone',
            [
                'id' => $this->primaryKey(11),
                'customer_id' => $this->integer()->unique(),
                'birth_name' => $this->date(),
                'number' => $this->string(),
            ],
            $this->defaultTableOptions()
        );

        $this->addForeignKey('customer_phone_numbers', 'phone', 'customer_id', 'customer', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('customer_phone_numbers', 'phone');
        $this->dropTable('phone');
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
