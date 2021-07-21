<?php

/*
 * This file is part of Simpermission.
 *
 * Copyright 2021 parsa shahmaleki <parsampsh@gmail.com>
 *
 * Simpermission project is Licensed Under MIT.
 * For more information, please see the LICENSE file.
 */

namespace Simpermission;

use Simpermission\Models\UserPermission;

trait HasPermissions
{
    /**
     * Permissions of this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(UserPermission::class);
    }

    /**
     * Returns list of the permissions names as a string array
     *
     * @return array
     */
    public function getPermissions()
    {
        $permissions = $this->permissions()->get(['permission']);
        $permissionsList = [];

        foreach ($permissions as $permission) {
            array_push($permissionsList, $permission->permission);
        }

        return $permissionsList;
    }

    /**
     * Checks that has user a specific permission
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission)
    {
        // manager has all the permissions by default
        if ($this->userIsManager()) {
            return true;
        }

        return (bool) $this->permissions()->where('permission', $permission)->first();
    }

    /**
     * Adds a new permission (if not exists) for the user
     *
     * @param string $permission
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addPermission(string $permission)
    {
        if ($this->hasPermission($permission)) {
            // currently has the permission
            return null;
        }

        return $this->permissions()->create([
            'permission' => $permission,
        ]);
    }

    /**
     * Deletes a permission for the user
     *
     * @param string $permission
     * @return bool
     */
    public function deletePermission(string $permission)
    {
        return $this->permissions()->where('permission', $permission)->delete();
    }
}
