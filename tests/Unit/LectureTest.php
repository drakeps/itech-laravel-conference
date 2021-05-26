<?php

namespace Tests\Unit;

use App\Models\Lecture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LectureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_accept_a_lecture()
    {
        $lecture = Lecture::factory()->create();

        $this->assertTrue($lecture->isNew);

        $lecture->accept();

        $this->assertTrue($lecture->accepted);
    }

    /** @test */
    public function it_reject_a_lecture()
    {
        $lecture = Lecture::factory()->create();

        $this->assertTrue($lecture->isNew);

        $lecture->reject();

        $this->assertFalse($lecture->accepted);
    }
}
