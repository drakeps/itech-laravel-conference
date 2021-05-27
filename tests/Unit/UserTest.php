<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_assign_role_to_the_user()
    {
        $role = Role::create(['name' => 'manager']);

        $user = User::factory()->create();

        $user->assignRole($role);

        $this->assertSame($role->id, $user->roles->first()->id);
    }

    /** @test */
    public function it_checks_if_user_has_a_role()
    {
        $role = Role::create(['name' => 'manager']);

        $user = User::factory()->create();

        $userWithRole = User::factory()->create();
        $userWithRole->roles()->attach($role);

        $this->assertFalse($user->hasRole('manager'));
        $this->assertTrue($userWithRole->hasRole('manager'));
        $this->assertTrue($userWithRole->hasRole(['manager']));
    }

    /** @test */
    public function it_returns_oly_users_have_role()
    {
        $role = Role::create(['name' => 'manager']);

        $userWithoutRole = User::factory()->create();

        $userWithRole = User::factory()->create();
        $userWithRole->roles()->attach($role);

        $this->assertCount(1, User::haveRole('manager')->get());
        $this->assertTrue(User::haveRole('manager')->first()->roles->first()->is($role));
    }
}
