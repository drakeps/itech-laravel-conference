<?php

namespace Tests\Unit;

use App\Models\Conference;
use App\Models\Lecture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConferenceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_return_only_accepted_lectures()
    {
        $conference = Conference::factory()->create();

        Lecture::factory()->count(1)->for($conference)->create();
        Lecture::factory()->accepted()->count(2)->for($conference)->create();

        $this->assertCount(2, $conference->acceptedLectures());
    }

    /** @test */
    public function it_check_if_conference_happened()
    {
        $conference = Conference::factory()->create([
            'start_date' => now()->addDay(),
        ]);

        $this->assertFalse($conference->isHappened());

        $conference = Conference::factory()->create([
            'start_date' => now()->subDay(),
        ]);

        $this->assertTrue($conference->isHappened());
    }
}
