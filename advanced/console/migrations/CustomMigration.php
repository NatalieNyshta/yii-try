<?php

namespace console\migrations;

use yii\db\Migration;

abstract class CustomMigration extends Migration
{
    private $tableOptions = null;

    public function defaultTableOptions()
    {
        if ($this->db->driverName === 'mysql') {
            //todo: get from params
            $this->tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';
        }

        return $this->tableOptions;
    }
}