<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $users = [
        //     [
        //         'username' => 'admin',
        //         'name' => 'admin',
        //         'email' => 'admin@mail.com',
        //         'password' => bcrypt('admin123'),
        //         'level' => 'admin',
        //         'status' => 'active'
        //     ],
        //     [
        //         'username' => 'ferdian',
        //         'name' => 'ferdian',
        //         'email' => 'ferdian@mail.com',
        //         'password' => bcrypt('ferdian123'),
        //         'level' => 'member',
        //         'status' => 'active'
        //     ],
        // ];

        // foreach ($users as  $u) {
        //     User::create($u);
        // }
        // \App\Models\User::factory(10)->create();
    }
}
