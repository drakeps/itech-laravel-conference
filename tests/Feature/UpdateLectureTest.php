<?php

namespace Tests\Feature;

use App\Models\Lecture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateLectureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function manager_can_accept_or_reject_lecture()
    {
        $this->loginAs('manager');

        $lecture = Lecture::factory()->create();

        $this->assertTrue($lecture->isNew);

        $this->post(route('lectures.accept', $lecture));

        $this->assertTrue($lecture->fresh()->accepted);

        $this->post(route('lectures.reject', $lecture));

        $this->assertFalse($lecture->fresh()->accepted);
    }

    /** @test */
    public function non_manager_cannot_delete_conference()
    {
        $this->login();

        $lecture = Lecture::factory()->create();

        $this->post(route('lectures.accept', $lecture))
            ->assertForbidden();

        $this->post(route('lectures.reject', $lecture))
            ->assertForbidden();
    }
}
