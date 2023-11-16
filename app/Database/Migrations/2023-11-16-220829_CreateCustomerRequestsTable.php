<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomerRequestsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'customer_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'null' => false,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false,
            ],
            'payload' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false,
                'default' => 'pending'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('customer_requests');
        $this->db->query('ALTER TABLE customer_requests MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('customer_requests');
    }
}
