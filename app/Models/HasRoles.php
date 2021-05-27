<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

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

    /**
     * Scope the model query to certain roles only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|array $roles
     */
    public function scopeHaveRole($query, $roles)
    {
        if (is_string($roles)) {
            $roles = [$roles];
        }

        return $query->whereHas('roles', function (Builder $query) use ($roles) {
            $query->whereIn('name', $roles);
        });
    }
}
