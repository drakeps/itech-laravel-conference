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
            'name'     => 'John Doe',
            'email'    => 'john@doe.ru',
            'password' => bcrypt('12345678'),
        ]);
        $manager->roles()->attach($roleManager);

        $simpleUser = User::create([
            'name'     => 'Jane Doe',
            'email'    => 'jane@doe.ru',
            'password' => bcrypt('12345678'),
        ]);
    }
}
