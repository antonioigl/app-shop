<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'AppShop',
            'email' => 'appshop185@gmail.com',
            'password' => bcrypt('123456'),
            'admin' => true,
            'username' => 'appshop'
        ]);

        User::create([
            'name' => 'Antonio',
            'email' => 'antonio241710@gmail.com',
            'password' => bcrypt('123456'),
            'username' => 'antonio'
        ]);

        factory(User::class, 2)->create();
    }

}
