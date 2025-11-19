<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnergyClimateTable extends Migration
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
            'total_konsumsi_listrik' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'comment'    => 'Total konsumsi listrik dalam kWh',
            ],
            'konsumsi_energi_terbarukan' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'comment'    => 'Konsumsi energi terbarukan dalam kWh',
            ],
            'persentase_energi_terbarukan' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'comment'    => 'Auto-calculated percentage',
            ],
            'peralatan_hemat_energi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'comment'    => 'Jumlah peralatan hemat energi',
            ],
            'bangunan_cerdas' => [
                'type'       => 'INT',
                'constraint' => 11,
                'comment'    => 'Jumlah bangunan cerdas',
            ],
            'jumlah_energi_terbarukan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'comment'    => 'Jumlah sumber energi terbarukan',
            ],
            'total_listrik_per_orang' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'comment'    => 'Total listrik per orang (kWh)',
            ],
            'rasio_energi_terbarukan' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'comment'    => 'Auto-calculated ratio',
            ],
            'bangunan_ramah_lingkungan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'comment'    => 'Jumlah bangunan ramah lingkungan',
            ],
            'program_pengurangan_emisi' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'comment'    => 'Ada program pengurangan emisi (0/1)',
            ],
            'jejak_karbon_per_orang' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'comment'    => 'Jejak karbon per orang (ton CO2)',
            ],
            'program_inovatif_energi' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'comment'    => 'Ada program inovatif energi (0/1)',
            ],
            'program_dampak_iklim' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'comment'    => 'Ada program dampak iklim (0/1)',
            ],
            'capaian_persen' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'comment'    => 'Auto-calculated achievement percentage',
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
        $this->forge->createTable('energy_climate');
    }

    public function down()
    {
        $this->forge->dropTable('energy_climate');
    }
}
