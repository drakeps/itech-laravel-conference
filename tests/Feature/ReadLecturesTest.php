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
    public function a_manager_can_view_all_lectures()
    {
        $this->loginAs('manager');

        $conference = Conference::factory()->create();
        $lectures   = Lecture::factory()
            ->withoutEvents()
            ->count(5)
            ->for(Member::factory())
            ->for($conference)
            ->create();

        $response = $this->get(route('conferences.show', $conference));

        foreach ($lectures as $lecture) {
            $response->assertSee($lecture->topic);
            $response->assertSee($lecture->member->name);
            $response->assertSee($lecture->member->unit);
        }
    }

    /** @test */
    public function a_user_can_view_only_accepted_lectures()
    {
        $conference = Conference::factory()->create();

        $lectures = Lecture::factory()
            ->count(3)
            ->for($conference)
            ->for(Member::factory())
            ->create();

        $acceptedLectures = Lecture::factory()
            ->count(2)
            ->accepted()
            ->for($conference)
            ->for(Member::factory())
            ->create();

        $response = $this->get(route('conferences.show', $conference));

        foreach ($acceptedLectures as $lecture) {
            $response->assertSee($lecture->topic);
        }

        foreach ($lectures as $lecture) {
            $response->assertDontSee($lecture->topic);
        }
    }

    /** @test */
    public function a_user_can_read_a_single_accepted_lecture()
    {
        $lecture = Lecture::factory()
            ->accepted()
            ->for(Conference::factory())
            ->for(Member::factory())
            ->create();

        $this->get(route('lectures.show', $lecture))
            ->assertSuccessful()
            ->assertSee($lecture->topic)
            ->assertSee($lecture->description)
            ->assertSee($lecture->member->fullName)
            ->assertSee($lecture->member->unit);
    }

    /** @test */
    public function manager_can_read_a_single_new_or_rejected_lecture()
    {
        $this->loginAs('manager');

        $lecture = Lecture::factory()
            ->withoutEvents()
            ->for(Conference::factory())
            ->for(Member::factory())
            ->create();

        $this->get(route('lectures.show', $lecture))
            ->assertSuccessful();
    }

    /** @test */
    public function a_user_cannot_read_a_single_new_or_rejected_lecture()
    {
        $lecture = Lecture::factory()
            ->for(Conference::factory())
            ->for(Member::factory())
            ->create();

        $this->get(route('lectures.show', $lecture))
            ->assertForbidden();
    }
}
