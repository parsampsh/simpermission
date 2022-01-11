<?php

/*
 * This file is part of Simpermission.
 *
 * Copyright 2021-2022 Parsa Shahmaleki <parsampsh@gmail.com>
 *
 * Simpermission project is Licensed Under MIT.
 * For more information, please see the LICENSE file.
 */

namespace Simpermission;

use Illuminate\Support\ServiceProvider;

class SimpermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../migrations');
    }
}
