<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnToUsersTable extends Migration
{
    public function up()
    {
        // Add a new column
        $this->forge->addColumn('users', [
            'is_admin' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'defualt' => false,
                'after' => 'active'
            ],
        ]);

        // Modify an existing column
        // $this->forge->modifyColumn('example_table', [
        //     'existing_column' => [
        //         'name' => 'modified_column',
        //         'type' => 'INT',
        //         'constraint' => 11,
        //     ],
        // ]);
    }

    public function down()
    {
        // Reverse the modifications if needed
        $this->forge->dropColumn('users', 'new_column');
        // $this->forge->modifyColumn('example_table', [
        //     'modified_column' => [
        //         'name' => 'existing_column',
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        // ]);
    }
}
