<?php

namespace Database\Seeders;

use App\Models\Conference;
use App\Models\Lecture;
use App\Models\Member;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->clearTables();

        $this->call(UserSeeder::class);
        $this->call(ConferenceSeeder::class);
    }

    public function clearTables()
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();
        User::truncate();
        Conference::truncate();
        Lecture::truncate();
        Member::truncate();

        Schema::enableForeignKeyConstraints();
    }
}
