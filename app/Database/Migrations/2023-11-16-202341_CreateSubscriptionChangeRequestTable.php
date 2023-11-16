<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubscriptionChangeRequestTable extends Migration
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
            'customer_details' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'subscription_details' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'billing_details' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'personal_details' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('subscription_modification_requests');
        $this->db->query('ALTER TABLE subscription_modification_requests MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('subscription_modification_requests');
    }
}
