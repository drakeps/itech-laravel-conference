<?php

namespace Tests\Feature;

use App\Models\Conference;
use App\Models\Lecture;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadLecturesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_manage_can_view_all_lectures()
    {
        $conference = Conference::factory()->create();
        $lectures   = Lecture::factory()
            ->count(5)
            ->has(Member::factory())
            ->for($conference)
            ->create();

        $response = $this->get(route('conferences.show', $conference));

        foreach ($lectures as $lecture) {
            $response->assertSee($lecture->topic);
            $response->assertSee($lecture->member->name);
            $response->assertSee($lecture->member->unit);
        }
    }
}
