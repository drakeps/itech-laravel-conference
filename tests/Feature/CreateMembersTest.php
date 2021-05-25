<?php

namespace Tests\Feature;

use App\Models\Conference;
use App\Models\Lecture;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateMembersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_become_a_speaker()
    {
        $conference = Conference::factory()->create();

        $this->post(route('members.store', $conference), [
            'name'           => 'John Doe',
            'email'          => 'john@doe.com',
            'unit'           => 'Департамент разработки',
            'become_speaker' => true,
            'topic'          => 'Тема доклада',
            'description'    => 'Описание доклада',
        ]);

        $member  = Member::first();
        $lecture = Lecture::first();

        $this->assertNotNull($member);
        $this->assertNotNull($lecture);

        $this->assertEquals($member->name, 'John Doe');
        $this->assertEquals($member->email, 'john@doe.com');
        $this->assertEquals($member->unit, 'Департамент разработки');

        $this->assertEquals($lecture->topic, 'Тема доклада');
        $this->assertEquals($lecture->description, 'Описание доклада');
    }

    /** @test */
    public function a_user_can_become_a_member()
    {
        $conference = Conference::factory()->create();

        $this->post(route('members.store', $conference), [
            'name'  => 'John Doe',
            'email' => 'john@doe.com',
            'unit'  => 'Департамент разработки',
        ]);

        $member  = Member::first();
        $lecture = Lecture::first();

        $this->assertNull($lecture);
        $this->assertNotNull($member);

        $this->assertEquals($member->name, 'John Doe');
        $this->assertEquals($member->email, 'john@doe.com');
        $this->assertEquals($member->unit, 'Департамент разработки');
    }
}
