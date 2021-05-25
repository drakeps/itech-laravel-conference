<?php

namespace Tests\Feature;

use App\Models\Conference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateConferencesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function manager_can_add_conference()
    {
        $this->loginAs('manager');

        $this->get(route('conferences.create'))
            ->assertSuccessful();

        $this->post(route('conferences.store'), [
            'topic'      => 'Крутая конференция',
            'start_date' => '17-07-2021',
        ])->assertRedirect();

        $conference = Conference::first();

        $this->assertNotNull($conference);
        $this->assertEquals($conference->topic, 'Крутая конференция');
        $this->assertEquals($conference->start_date, '17-07-2021');
    }

    /** @test */
    public function non_manager_cannot_add_conference()
    {
        $this->login();

        $response = $this->get(route('conferences.create'));
        $response->assertForbidden();

        $response = $this->post(route('conferences.store'), []);
        $response->assertForbidden();
    }

    /** @test */
    public function a_conference_requires_a_title()
    {
        $this->loginAs('manager');

        $this->post(route('conferences.store'), ['topic' => ''])
            ->assertSessionHasErrors('topic');
    }

    /** @test */
    public function a_conference_requires_a_start_date()
    {
        $this->loginAs('manager');

        $this->post(route('conferences.store'), ['start_date' => ''])
            ->assertSessionHasErrors('start_date');
    }

    /** @test */
    public function a_conference_requires_a_valid_start_date()
    {
        $this->loginAs('manager');

        $this->post(route('conferences.store'), ['start_date' => 'not-valid-date'])
            ->assertSessionHasErrors('start_date');
    }
}
