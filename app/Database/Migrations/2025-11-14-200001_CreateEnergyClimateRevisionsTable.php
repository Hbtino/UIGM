<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnergyClimateRevisionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'energy_climate_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'revision_type' => [
                'type'       => 'ENUM',
                'constraint' => ['request', 'approved', 'rejected'],
                'default'    => 'request',
            ],
            'requested_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'alasan_revisi' => [
                'type' => 'TEXT',
            ],
            'data_revisi' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'reviewed_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
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
        $this->forge->addKey('energy_climate_id');
        $this->forge->addKey('status');
        $this->forge->createTable('energy_climate_revisions');
    }

    public function down()
    {
        $this->forge->dropTable('energy_climate_revisions');
    }
}
