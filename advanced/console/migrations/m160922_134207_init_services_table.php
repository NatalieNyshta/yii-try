<?php

use console\migrations\CustomMigration;

class m160922_134207_init_services_table extends CustomMigration
{
    public function up()
    {
        $this->createTable(
            'service',
            [
                'id' => $this->primaryKey(11),
                'name' => $this->string()->unique(),
                'hourly_rate' => $this->integer(),
            ],
            $this->defaultTableOptions()
        );
    }

    public function down()
    {
        $this->dropTable('service');
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
