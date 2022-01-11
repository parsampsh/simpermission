# Simpermission - A PHP library for Laravel
Simpermission is a PHP library for implementing a simple permission management system for users in laravel apps.

Features:

```php
$user->addPermission('what.i.want');
$user->deletePermission('what.i.want');
$user->getPermissions(); // ['foo.bar', 'hello.world'...]

if (! $user->hasPermission('some.thing')) {
    abort(403);
}
```

## Getting started
To get started with this package, first you need to install it in your laravel app using composer:

```shell
$ composer install parsampsh/simpermission
```

Then, you need to run the migrations:

```shell
$ php artisan migrate
```

Now, you have to add two things in your User model:

```php
use Simpermission\HasPermissions;

class User
{
    // ...

    use HasPermissions;

    public function userIsManager()
    {
        return false;
    }

    // ...
}
```

You saw some methods like `addPermission` above that was added to your user model.
The `HasPermissions` trait adds them to your model.

Also, there is another concept named **Manager user** or **Super user**.
The manager user should access anything.
When you use `hasPermission` method for checking a permission for a user,
The same permission should be added via `addPermission` method.
But for manager user, anything is allowed.

To determine that which user is manager(full permission access) and which one is not,
you should implement a method named `userIsManager` in your user model:

```php
class User
{
    // ...

    public function userIsManager()
    {
        // example
        return $this->is_manager === 1;
    }

    // ...
}
```

## License
This project is licensed under [MIT](LICENSE).
