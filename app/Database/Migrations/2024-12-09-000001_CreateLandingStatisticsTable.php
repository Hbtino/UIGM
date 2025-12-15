<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLandingStatisticsTable extends Migration
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
            'section' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => 'Section identifier: info_box, profil_kampus, fasilitas, ranking',
            ],
            'key_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => 'Key untuk data statistik',
            ],
            'label' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'comment' => 'Label yang ditampilkan',
            ],
            'value' => [
                'type' => 'TEXT',
                'comment' => 'Nilai statistik',
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'comment' => 'Icon class (fas fa-xxx)',
            ],
            'color' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'comment' => 'Warna untuk styling',
            ],
            'order_position' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'comment' => 'Urutan tampilan',
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => 'Status aktif/nonaktif',
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
        $this->forge->addUniqueKey(['section', 'key_name'], 'unique_section_key');
        $this->forge->createTable('landing_statistics');

        // Insert default data
        $data = [
            // Info Box Section
            ['section' => 'info_box', 'key_name' => 'target_skor', 'label' => 'Target Skor 2028', 'value' => '80%', 'icon' => 'fa-chart-line', 'color' => '#6366f1', 'order_position' => 1],
            ['section' => 'info_box', 'key_name' => 'ranking_dunia', 'label' => 'Target Ranking Dunia', 'value' => '#176', 'icon' => 'fa-trophy', 'color' => '#10b981', 'order_position' => 3],
            ['section' => 'info_box', 'key_name' => 'ranking_indonesia', 'label' => 'Target Ranking Indonesia', 'value' => '#26', 'icon' => 'fa-flag', 'color' => '#ec4899', 'order_position' => 5],
            ['section' => 'info_box', 'key_name' => 'kriteria_sdgs', 'label' => 'Kriteria Keberlanjutan', 'value' => '6', 'icon' => 'fa-leaf', 'color' => '#06b6d4', 'order_position' => 7],

            // Profil Kampus
            ['section' => 'profil_kampus', 'key_name' => 'mahasiswa', 'label' => 'Mahasiswa', 'value' => '6605', 'icon' => 'fa-user-graduate', 'color' => '#1e3a8a', 'order_position' => 1],
            ['section' => 'profil_kampus', 'key_name' => 'dosen', 'label' => 'Dosen', 'value' => '482', 'icon' => 'fa-chalkboard-teacher', 'color' => '#1e3a8a', 'order_position' => 2],
            ['section' => 'profil_kampus', 'key_name' => 'jurusan', 'label' => 'Jurusan', 'value' => '10', 'icon' => 'fa-building', 'color' => '#1e3a8a', 'order_position' => 3],
            ['section' => 'profil_kampus', 'key_name' => 'program_studi', 'label' => 'Program Studi', 'value' => '39', 'icon' => 'fa-graduation-cap', 'color' => '#1e3a8a', 'order_position' => 4],

            // Fasilitas
            ['section' => 'fasilitas', 'key_name' => 'luas_kampus', 'label' => 'Luas Kampus', 'value' => '246269', 'icon' => 'fa-map', 'color' => '#1e3a8a', 'order_position' => 1],
            ['section' => 'fasilitas', 'key_name' => 'luas_kampus_unit', 'label' => 'Unit Luas Kampus', 'value' => 'm²', 'order_position' => 2],
            ['section' => 'fasilitas', 'key_name' => 'luas_bangunan', 'label' => 'Luas Bangunan', 'value' => '93435', 'icon' => 'fa-building', 'color' => '#1e3a8a', 'order_position' => 3],
            ['section' => 'fasilitas', 'key_name' => 'luas_bangunan_unit', 'label' => 'Unit Luas Bangunan', 'value' => 'm²', 'order_position' => 4],
            ['section' => 'fasilitas', 'key_name' => 'jumlah_bangunan', 'label' => 'Jumlah Bangunan', 'value' => '86', 'icon' => 'fa-city', 'color' => '#1e3a8a', 'order_position' => 5],
            ['section' => 'fasilitas', 'key_name' => 'laboratorium', 'label' => 'Laboratorium', 'value' => '119', 'icon' => 'fa-flask', 'color' => '#1e3a8a', 'order_position' => 6],
        ];

        foreach ($data as $row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $row['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('landing_statistics')->insert($row);
        }
    }

    public function down()
    {
        $this->forge->dropTable('landing_statistics');
    }
}
