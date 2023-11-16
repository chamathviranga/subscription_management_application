<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubscriptionsTable extends Migration
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
                'constraint' => '100',
                'null' => false
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => true

            ],
            'price' => [
                'type' => 'DOUBLE',
                'constraint' => '10,2',
                'null' => false, 
                'default' => 0.0,
            ],
            'duration' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false, 
                'default' => 1,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('subscriptions');
    }

    public function down()
    {
        $this->forge->dropTable('subscriptions');
    }
}
