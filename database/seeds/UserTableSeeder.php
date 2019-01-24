<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Antonie';
        $user->email = 'antonie@symphony.com';
        $user->password = bcrypt('mocko');
        $user->save();
        $user->roles()->attach(Role::where('name', 'admin')->first());

        $admin = new User;
        $admin->name = 'Markonie';
        $admin->email = 'markonie@symphony.com';
        $admin->password = bcrypt('mocko');
        $admin->save();
        $admin->roles()->attach(Role::where('name', 'user')->first());

    }
}
