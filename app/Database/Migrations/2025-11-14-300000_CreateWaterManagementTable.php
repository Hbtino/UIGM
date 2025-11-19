<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWaterManagementTable extends Migration
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
            'tahun' => [
                'type'       => 'INT',
                'constraint' => 4,
                'unique'     => true,
            ],
            'total_konsumsi_air' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'comment'    => 'Total konsumsi air dalam m³',
            ],
            'air_daur_ulang' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'comment'    => 'Air daur ulang dalam m³',
            ],
            'persentase_air_daur_ulang' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'comment'    => 'Auto-calculated percentage',
            ],
            'konsumsi_air_per_orang' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'comment'    => 'Auto-calculated per capita',
            ],
            'program_konservasi_air' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'sistem_daur_ulang_air' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'teknologi_hemat_air' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'program_edukasi_air' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'capaian_persen' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'comment'    => 'Auto-calculated achievement',
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status_verifikasi' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'catatan_verifikasi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'bukti_pendukung' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'verified_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'updated_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
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
        
        $this->forge->addKey('status_verifikasi');
        $this->forge->createTable('water_management');
    }

    public function down()
    {
        $this->forge->dropTable('water_management');
    }
}

