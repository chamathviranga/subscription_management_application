<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBillingTable extends Migration
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
            'subscription_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'valid_from' => [
                'type' => 'TIMESTAMP',
                'null' => false
            ],
            'valid_to' => [
                'type' => 'TIMESTAMP',
                'null' => false
            ],
            'price' => [
                'type' => 'DOUBLE',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.0,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false,
                'default' => 'active'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('billing');
        $this->db->query('ALTER TABLE billing MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('billing');
    }
}
