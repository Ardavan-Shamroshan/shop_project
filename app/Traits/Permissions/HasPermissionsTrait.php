<?php

namespace App\Traits\Permissions;

use App\Models\User\Permission;
use App\Models\User\Role;

trait HasPermissionsTrait
{
    // many to many user-permissions relation
    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    // many to many user-roles relation
    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    // Check if user has permission or not
    public function hasPermission($permission) {
        return (bool) $this->permissions()->where('name', $permission->name)->count();
    }

    // Check if user has roles or not using spread operator.
    // Usage: $user->hasRole('admin', 'operator')
    // Spread operator: you can use the spread operator to merge arrays -> ['admin', 'operator']
    public function hasRole(...$roles) {
        foreach ($roles as $role)
            // If $role exists in $user->roles name field
            if ($this->roles->contains('name', $role))
                return true;
        return false;
    }

    // Check if user has permission or has role which has the permission through the role (hasPermissionThroughRole)
    public function hasPermissionTo($permission)
    {
    return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }


    // Is the given permission belongs to one of the user roles ?
    public function hasPermissionThroughRole($permission)
    {
        foreach($permission->roles as $role) {
            if($this->roles->contains($role))
                return true;
        }
        return false;
    }

}
