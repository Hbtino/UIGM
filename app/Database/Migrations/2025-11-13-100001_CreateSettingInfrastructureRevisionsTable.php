<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingInfrastructureRevisionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'setting_infrastructure_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'revision_type' => [
                'type' => 'ENUM',
                'constraint' => ['request', 'approved', 'rejected'],
                'default' => 'request',
            ],
            'requested_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'alasan_revisi' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'data_revisi' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default' => 'pending',
            ],
            'reviewed_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'review_notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'reviewed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('setting_infrastructure_id');
        $this->forge->createTable('setting_infrastructure_revisions');
    }

    public function down()
    {
        $this->forge->dropTable('setting_infrastructure_revisions');
    }
}
