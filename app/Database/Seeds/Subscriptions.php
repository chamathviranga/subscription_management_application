<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Subscriptions extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => '1 Months package',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy ',
                'is_active' => 1,
                'price' => '500',
                'duration' => 1,
            ],
            [
                'name' => '3 Months package',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy ',
                'is_active' => 1,
                'price' => '1500',
                'duration' => 3,
            ],
            [
                'name' => '6 Months package',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy ',
                'is_active' => 1,
                'price' => '3000',
                'duration' => 6,
            ],
            [
                'name' => '12 Months package',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy ',
                'is_active' => 1,
                'price' => '6000',
                'duration' => 12,
            ],
        ];


        $this->db->table('your_table_name')->insertBatch($data);
    }
}
