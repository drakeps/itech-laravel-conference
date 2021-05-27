<?php

namespace Database\Seeders;

use App\Models\Conference;
use App\Models\Lecture;
use App\Models\Member;
use Illuminate\Database\Seeder;

class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conferences = Conference::factory(5)->create();

        foreach ($conferences as $conference) {
            Member::factory()->count(3)->for($conference)->create();

            for ($i = 1; $i <= 4; $i++) {
                Lecture::factory()
                    ->withoutEvents()
                    ->for(Member::factory()->for($conference))
                    ->for($conference)
                    ->create();
            }
        }
    }
}
