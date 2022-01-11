<?php

/*
 * This file is part of Simpermission.
 *
 * Copyright 2021-2022 Parsa Shahmaleki <parsampsh@gmail.com>
 *
 * Simpermission project is Licensed Under MIT.
 * For more information, please see the LICENSE file.
 */

namespace Simpermission\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

require_once __DIR__ . '/database/Models.php';
require_once __DIR__ . '/database/factories/UserFactory.php';

class TestCase extends Orchestra
{
    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        include_once __DIR__ . '/database/migrations/create_users_table.php';
        include_once __DIR__ . '/../migrations/2021_07_18_092042_create_user_permissions_table.php';
        (new \CreateUsersTable())->up();
        (new \CreateUserPermissionsTable())->up();
    }
}
