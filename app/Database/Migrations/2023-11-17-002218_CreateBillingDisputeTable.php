<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBillingDisputeTable extends Migration
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
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'null' => false,
            ],
            'issue' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'other_details' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'preferred_resolution' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => false,
            ],
            'support_document' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('billing_disputes');
        $this->db->query('ALTER TABLE billing_disputes MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('billing_disputes');
    }
}
