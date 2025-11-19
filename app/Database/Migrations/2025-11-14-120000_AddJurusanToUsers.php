<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJurusanToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'role'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'jurusan');
    }
}
