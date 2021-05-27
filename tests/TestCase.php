<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createUserByRole($roleName)
    {
        $role = Role::create(['name' => $roleName]);

        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }

    protected function login($user = null)
    {
        $user = $user ?: User::factory()->create();

        $this->actingAs($user);

        return $user;
    }

    protected function loginAs($roleName)
    {
        $user = $this->createUserByRole($roleName);

        return $this->login($user);
    }
}
