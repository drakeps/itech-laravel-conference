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

        $this->assertFalse($lecture->accepted);

        $lecture->accept();

        $this->assertTrue($lecture->accepted);
    }
}
