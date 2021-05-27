<?php

namespace Tests\Feature;

use App\Models\Conference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadConferencesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_conferences_on_homepage()
    {
        $conferences = Conference::factory(3)->create();

        $response = $this->get('/');

        $response->assertSuccessful();

        foreach ($conferences as $conference) {
            $response->assertSee($conference->topic);
            $response->assertSee($conference->start_date);
        }
    }

    /** @test */
    public function a_user_can_read_a_single_conference()
    {
        $conference = Conference::factory()->create();

        $this->get(route('conferences.show', $conference))
            ->assertSuccessful()
            ->assertSee($conference->topic);
    }

    /** @test */
    public function a_user_can_see_button_become_member_only_if_conference_did_not_happened()
    {
        $conference = Conference::factory()->create([
            'start_date' => now()->addDay(),
        ]);

        $this->get(route('conferences.show', $conference))
            ->assertSee('Хочу участвовать');

        $heppenedConference = Conference::factory()->create([
            'start_date' => now()->subDay(),
        ]);

        $this->get(route('conferences.show', $heppenedConference))
            ->assertDontSee('Хочу участвовать');
    }
}
