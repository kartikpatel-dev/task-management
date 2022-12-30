<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissionsTrait
{
    // get permissions
    public function getAllPermissions($permission)
    {
        return Permission::whereIn('slug', $permission)->get();
    }

    // check has permission
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    // check has role
    public function hasRole($roles)
    {
        $roles = explode('|', $roles);
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }

    // has permission through role
    public function hasPermissionThroughRole($permissions)
    {
        foreach ($permissions->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }

        return false;
    }

    // has permission to
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    // girve permission to
    public function givePermissionTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);

        if ($permissions == null) {
            return $this;
        }

        $this->permissions()->saveMany($permissions);
        return $this;
    }

    // user permissions relationship
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * Return default User Role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Return alternative User Roles.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    /**
     * Return all User Roles, merging the default and alternative roles.
     */
    public function roles_all()
    {
        return collect([$this->role()])->merge($this->roles());
    }
}
