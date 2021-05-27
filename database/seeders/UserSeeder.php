<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleManager = Role::create(['name' => 'manager']);

        $manager = User::create([
            'name'     => 'Manager',
            'email'    => 'b24.itech@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $manager->roles()->attach($roleManager);

        $manager2 = User::create([
            'name'     => 'Manager',
            'email'    => 'drakeps@mail.ru',
            'password' => bcrypt('12345678'),
        ]);
        $manager2->roles()->attach($roleManager);

        $simpleUser = User::create([
            'name'     => 'Jane Doe',
            'email'    => 'jane@doe.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
