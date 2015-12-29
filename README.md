Trusty - Roles and Permissions for Laravel 5
==============

Installation

Open your composer.json file, and add the new required package.

"trieu/trusty": "dev-master"

Next, open a terminal and run.

composer update

Next, Add new service provider in config/app.php.

"Trieu\Trusty\TrustyServiceProvider::class",

Next, Add new aliases in config/app.php.

"Trusty"      => Trieu\Trusty\Facades\Trusty::class,
"Role"        => Trieu\Trusty\Role::class,
"Permission"  => Trieu\Trusty\Permission::class',


Next, publish the package's migrations.

php artisan vendor:publish


NOTE: If you want to modify the roles and permissions table, you can publish the migration.

Done.

Usage

Add Trieu\Trusty\Traits\TrustyTrait trait to your User model. For example.

<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Trieu\Trusty\Traits\TrustyTrait;

class User extends \Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait, TrustyTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

}
?>

Creating A Role.

With description.

Role::create([
    'name'          =>  'Administrator',
    'slug'          =>  Str::slug('Administrator', '_'),
    'description'   =>  'The Super Administrator'
]);
Without description.

Role::create([
    'name'  =>  'Editor',
    'slug'  =>  Str::slug('Editor', '_'),
]);

Creating A Permission

With description.

Permission::create([
    'name'          =>  'Manage Users',
    'slug'          =>  Str::slug('Manage Users', '_'), // manage_users
    'description'   =>  'Create, Read, Update and Delete Users'
]);
Without description.

Permission::create([
    'name'          =>  'Manage Posts',
    'slug'          =>  Str::slug('Manage Posts', '_'), // manage_posts
]);

Adding Permission to Role.

$permission_id = 1;
$role = Role::findOrFail(1);
$role->permissions()->attach($permission_id);

Adding Role to User.

By Role ID.

Auth::user()->addRole(1);
By Slug Or Name.

Auth::user()->addRole('admin');

Auth::user()->addRole('Administrator');

Checking Role User

Checking single role.

if(Auth::user()->is('administrator'))
{
    // your code here
}
Multiple roles.

if(Auth::user()->is('administrator', 'subscriber'))
{
    // your code here
}
Or using magic method.

if(Auth::user()->isAdministrator())
{
    // your code
}

Checking User Permission

Single check.

if(Auth::user()->can('manage_users'))
{
    // your code here
}
Checking multiple permissions.

if(Auth::user()->can('manage_users', 'manage_pages'))
{
    // your code here
}
Or using magic method.

if(Auth::user()->canManageUsers())
{
    // your code here
}
Check permissions against a role.

$role = Role::findOrFail(1);

if ($role->can('manage_users'))
{
    // your code here
}
Or using magic method.

$role = Role::findOrFail(1);

if($role->canManageUsers())
{
    // your code here
}
