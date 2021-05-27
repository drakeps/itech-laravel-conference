<?php

namespace Tests\Feature;

use App\Models\Conference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateConferenceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function manager_can_update_conference()
    {
        $this->loginAs('manager');

        $conference = Conference::factory()->create();

        $this->get(route('conferences.edit', $conference))
            ->assertSuccessful();

        $this->patch(route('conferences.update', $conference), [
            'topic'      => 'UPDATED Крутая конференция',
            'start_date' => '17.07.2022',
        ])->assertRedirect();

        $this->assertEquals($conference->fresh()->topic, 'UPDATED Крутая конференция');
        $this->assertEquals($conference->fresh()->start_date, '17.07.2022');
    }

    /** @test */
    public function non_manager_cannot_update_conference()
    {
        $this->login();

        $conference = Conference::factory()->create();

        $response = $this->get(route('conferences.edit', $conference));
        $response->assertForbidden();

        $response = $this->patch(route('conferences.update', $conference), []);
        $response->assertForbidden();
    }

    /** @test */
    public function manager_can_delete_conference()
    {
        $this->loginAs('manager');

        $conference = Conference::factory()->create();

        $this->assertNotNull($conference);

        $this->delete(route('conferences.destroy', $conference));

        $this->assertNull($conference->fresh());
    }

    /** @test */
    public function non_manager_cannot_delete_conference()
    {
        $this->login();

        $conference = Conference::factory()->create();

        $this->assertNotNull($conference);

        $this->delete(route('conferences.destroy', $conference))
            ->assertForbidden();

        $this->assertNotNull($conference->fresh());
    }
}
