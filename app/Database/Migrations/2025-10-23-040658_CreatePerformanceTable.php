<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerformanceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'activity_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'metric' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'target' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'achievement' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'date' => [
                'type'       => 'DATE',
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('activity_id', 'activities', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('performance');
    }

    public function down()
    {
        $this->forge->dropTable('performance');
    }
}
