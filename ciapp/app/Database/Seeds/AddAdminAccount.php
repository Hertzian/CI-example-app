<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use App\Models\UserModel;

class AddAdminAccount extends Seeder
{
    public function run()
    {
        $user =  new User([
            'email' => 'admin@test.com',
            'password' => 'Password',
            'first_name' => 'Administrator'
        ]);

        $model = new UserModel;

        $model->save($user);

        $user = $model->findById($model->getInsertID());

        // automatically activate the user
        $user->activate();

        $user->addGroup('user', 'admin');
    }
}
