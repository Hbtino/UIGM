<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRememberTokenActiveToUsers extends Migration
{
    public function up()
    {
        // Check if remember_token column exists, if not add it
        if (!$this->db->fieldExists('remember_token', 'users')) {
            $this->forge->addColumn('users', [
                'remember_token' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true
                ]
            ]);
        }
        
        // Check if remember_token_expires column exists, if not add it
        if (!$this->db->fieldExists('remember_token_expires', 'users')) {
            $this->forge->addColumn('users', [
                'remember_token_expires' => [
                    'type' => 'DATETIME',
                    'null' => true
                ]
            ]);
        }
        
        // Add remember_token_active column to users table
        if (!$this->db->fieldExists('remember_token_active', 'users')) {
            $this->forge->addColumn('users', [
                'remember_token_active' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'default'    => 1,
                    'null'       => false
                ]
            ]);
            
            // Set default value to 1 for all existing records with tokens
            $this->db->query("UPDATE users SET remember_token_active = 1 WHERE remember_token IS NOT NULL");
        }
    }

    public function down()
    {
        // Remove remember_token_active column
        if ($this->db->fieldExists('remember_token_active', 'users')) {
            $this->forge->dropColumn('users', 'remember_token_active');
        }
    }
}
