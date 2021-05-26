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
        $this->createMember([
            'firstname'      => 'John',
            'lastname'       => 'Doe',
            'email'          => 'john@doe.com',
            'unit'           => 'Департамент разработки',
            'become_speaker' => true,
            'topic'          => 'Тема доклада',
            'description'    => 'Описание доклада',
        ]);

        $lecture = Lecture::first();

        $this->assertNotNull($lecture);
        $this->assertNotNull($lecture->member);

        $this->assertEquals($lecture->member->firstname, 'John');
        $this->assertEquals($lecture->member->lastname, 'Doe');
        $this->assertEquals($lecture->member->email, 'john@doe.com');
        $this->assertEquals($lecture->member->unit, 'Департамент разработки');

        $this->assertEquals($lecture->topic, 'Тема доклада');
        $this->assertEquals($lecture->description, 'Описание доклада');
    }

    /** @test */
    public function a_user_can_become_a_member()
    {
        $this->createMember([
            'firstname' => 'John',
            'lastname'  => 'Doe',
            'email'     => 'john@doe.com',
            'unit'      => 'Департамент разработки',
        ]);

        $member  = Member::first();
        $lecture = Lecture::first();

        $this->assertNull($lecture);
        $this->assertNotNull($member);

        $this->assertEquals($member->firstname, 'John');
        $this->assertEquals($member->lastname, 'Doe');
        $this->assertEquals($member->email, 'john@doe.com');
        $this->assertEquals($member->unit, 'Департамент разработки');
    }

    /** @test */
    public function a_memeber_requires_a_firstname()
    {
        $this->createMember(['firstname' => ''])->assertSessionHasErrors('firstname');
    }

    /** @test */
    public function a_memeber_requires_a_lastname()
    {
        $this->createMember(['lastname' => ''])->assertSessionHasErrors('lastname');
    }

    /** @test */
    public function a_memeber_requires_a_email()
    {
        $this->createMember(['email' => ''])->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_memeber_requires_a_valid_email()
    {
        $this->createMember(['email' => 'non-valid-email'])->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_memeber_requires_a_unit()
    {
        $this->createMember(['unit' => ''])->assertSessionHasErrors('unit');
    }

    /** @test */
    public function it_requires_a_topic_if_member_is_speaker()
    {
        $this->createMember(['topic' => ''])->assertSessionDoesntHaveErrors('topic');

        $this->createMember([
            'become_speaker' => 1,
            'topic'          => '',
        ])->assertSessionHasErrors('topic');
    }

    /** @test */
    public function it_requires_a_description_if_member_is_speaker()
    {
        $this->createMember(['description' => ''])->assertSessionDoesntHaveErrors('description');

        $this->createMember([
            'become_speaker' => 1,
            'description'    => '',
        ])->assertSessionHasErrors('description');
    }

    /**
     * @param array $data
     * @return \Illuminate\Testing\TestResponse
     */
    protected function createMember($data = [])
    {
        $conference = Conference::factory()->create();

        return $this->post(route('members.store', $conference), $data);
    }
}
