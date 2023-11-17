<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentMethods extends Seeder
{
    public function run()
    {
        $data = [
            [
                'method' => 'Visa',
            ],
            [
                'method' => 'Master',
            ],
            [
                'method' => 'Cash',
            ],
            [
                'method' => 'Bank Deposit',
            ],
            [
                'method' => 'Google Pay',
            ],
            [
                'method' => 'Paypal',
            ],
            
        ];


        $this->db->table('payment_methods')->insertBatch($data);
    }
}
