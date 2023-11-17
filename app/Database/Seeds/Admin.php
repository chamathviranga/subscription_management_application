<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;

class Admin extends Seeder
{
    public function run()
    {
        $users = auth()->getProvider();
        
        $user = new User([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'alpha'
        ]);

        $users->save($user);
        $user = $users->findById($users->getInsertID());

        $user->addGroup('admin');
    }
}
