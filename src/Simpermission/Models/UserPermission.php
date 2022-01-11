<?php

/*
 * This file is part of Simpermission.
 *
 * Copyright 2021-2022 Parsa Shahmaleki <parsampsh@gmail.com>
 *
 * Simpermission project is Licensed Under MIT.
 * For more information, please see the LICENSE file.
 */

namespace Simpermission\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * Permissions for the users
 */
class UserPermission extends Model
{
    /**
     * @inheritdoc
     */
    protected $fillable = ['permission'];

    /**
     * The user that owns this permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
