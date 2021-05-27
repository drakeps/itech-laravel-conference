<?php

namespace Tests\Feature;

use App\Models\Conference;
use App\Models\Lecture;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadMembersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_conference_members()
    {

        $conference = Conference::factory()->create();

        $rejectedSpeaker = Member::factory()
            ->count(2)
            ->for($conference)
            ->has(Lecture::factory()->for($conference))
            ->create();

        $acceptedSpeaker = Member::factory()
            ->count(3)
            ->for($conference)
            ->has(Lecture::factory()->for($conference))
            ->create();

        $members = Member::factory()
            ->count(4)
            ->for($conference)
            ->create();

        $allMembers = $rejectedSpeaker->merge($acceptedSpeaker)->merge($members);

        $response = $this->get(route('members.index', $conference));

        foreach ($allMembers as $speaker) {
            $response->assertSee($speaker->fullName);
            $response->assertSee($speaker->unit);
        }
    }
}
