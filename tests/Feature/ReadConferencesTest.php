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
}
