<?php

/*
 * This file is part of Simpermission.
 *
 * Copyright 2021 parsa shahmaleki <parsampsh@gmail.com>
 *
 * Simpermission project is Licensed Under MIT.
 * For more information, please see the LICENSE file.
 */

namespace Simpermission\Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user permission can be added.
     *
     * @return void
     */
    public function testUserPermissionCanBeAdded()
    {
        $user = User::factory()->create();
        $this->assertEquals($user->getPermissions(), []);
        $this->assertFalse($user->hasPermission('foo.bar'));

        $user->addPermission('foo.bar');
        $this->assertTrue($user->hasPermission('foo.bar'));
        $this->assertEquals($user->getPermissions(), ['foo.bar']);

        $user->addPermission('hello.world');
        $this->assertTrue($user->hasPermission('foo.bar'));
        $this->assertTrue($user->hasPermission('hello.world'));
        $this->assertEquals($user->getPermissions(), ['foo.bar', 'hello.world']);
    }

    /**
     * Test user permission can be deleted
     *
     * @return void
     */
    public function testUserPermissionCanBeDeleted()
    {
        $user = User::factory()->create();

        $this->assertEquals($user->getPermissions(), []);
        $user->addPermission('foo.bar');
        $user->addPermission('hello.world');
        $this->assertEquals($user->getPermissions(), ['foo.bar', 'hello.world']);

        $user->deletePermission('foo.bar');
        $this->assertFalse($user->hasPermission('foo.bar'));
        $this->assertEquals($user->getPermissions(), ['hello.world']);

        $user->deletePermission('foo.bar'); // delete when permission doesn't exists
        $this->assertFalse($user->hasPermission('foo.bar'));
        $this->assertEquals($user->getPermissions(), ['hello.world']);
    }

    /**
     * Test manager user has all the permission by default
     * @return void
     */
    public function testManagerHasAllPermissions()
    {
        $user = User::factory()->create(['access_level' => 1]);

        $this->assertTrue($user->hasPermission('foo.bar'));
        $user->addPermission('foo.bar');
        $this->assertTrue($user->hasPermission('foo.bar'));
    }
}
