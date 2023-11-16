<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomerSubscriptionsTable extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
            ],
            'billing_street' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'billing_city' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'billing_state' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'billing_postal_code' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'billing_country' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'subscription_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'null' => false,
            ],
            'payment_method' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'null' => false,
            ],
            'customer_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('payment_method', 'payment_methods', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('subscription_id', 'subscriptions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('customer_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('customer_subscriptions');
        $this->db->query('ALTER TABLE customer_subscriptions MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('customer_subscriptions');
    }
}
