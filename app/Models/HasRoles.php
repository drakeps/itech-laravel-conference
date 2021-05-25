<?php

namespace App\Models;

trait HasRoles
{
    /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Assign the given role to the model.
     *
     * @param array|Role $roles
     *
     * @return $this
     */
    public function assignRole($roles)
    {
        if ($roles instanceof Role) {
            $roles = [$roles];
        }

        foreach ($roles as $role) {
            $this->roles()->attach($role);
        }

        return $this;
    }

    /**
     * Check if the user has (one of) the given role(s).
     * @param string|array $roles
     *
     * @return bool
     */
    public function hasRole($roles)
    {
        if (is_string($roles)) {
            $roles = [$roles];
        }

        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }

        return false;
    }
}
