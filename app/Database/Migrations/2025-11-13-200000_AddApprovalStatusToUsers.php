<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddApprovalStatusToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'approval_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default' => 'pending',
                'null' => false,
                'after' => 'role'
            ],
            'approved_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'approval_status'
            ],
            'approved_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'approved_by'
            ],
            'rejection_reason' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'approved_at'
            ]
        ];
        
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [
            'approval_status',
            'approved_by',
            'approved_at',
            'rejection_reason'
        ]);
    }
}
