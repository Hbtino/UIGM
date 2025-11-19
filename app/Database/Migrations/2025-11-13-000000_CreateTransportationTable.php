<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransportationTable extends Migration
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
            'tahun' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => false,
            ],
            'total_perjalanan' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'perjalanan_ramah_lingkungan' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'jumlah_kendaraan' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'jumlah_populasi' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'rasio_kendaraan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'layanan_antar_jemput' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'kebijakan_zev' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'luas_parkir' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'program_pembatasan_parkir' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'inisiatif_pengurangan_kendaraan' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'jalur_pejalan_kaki' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'sepeda_kampus' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'capaian_persen' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 0,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status_verifikasi' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default' => 'pending',
            ],
            'catatan_verifikasi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'bukti_pendukung' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'verified_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        $this->forge->addUniqueKey('tahun');
        $this->forge->createTable('transportation');
    }

    public function down()
    {
        $this->forge->dropTable('transportation');
    }
}
