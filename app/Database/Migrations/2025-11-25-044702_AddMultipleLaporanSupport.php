<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMultipleLaporanSupport extends Migration
{
    public function up()
    {
        // Drop foreign key constraints first
        if ($this->db->DBDriver === 'MySQLi') {
            $this->db->query('ALTER TABLE laporan_dosen DROP FOREIGN KEY laporan_dosen_user_id_foreign');
            $this->db->query('ALTER TABLE laporan_kaprodi DROP FOREIGN KEY laporan_kaprodi_user_id_foreign');
        }
        
        // Drop existing tables
        $this->forge->dropTable('laporan_dosen', true);
        $this->forge->dropTable('laporan_kaprodi', true);
        
        // Recreate laporan_dosen table with auto_increment id (not unique user_id)
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'user_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'program_studi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'data_laporan' => [
                'type' => 'LONGTEXT',
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('laporan_dosen');

        // Recreate laporan_kaprodi table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'user_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'prodi_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'prodi_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'kaprodi_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tanggal_laporan' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'data_laporan' => [
                'type' => 'LONGTEXT',
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('laporan_kaprodi');
    }

    public function down()
    {
        $this->forge->dropTable('laporan_dosen');
        $this->forge->dropTable('laporan_kaprodi');
    }
}
