<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


 ############################################################################

 ##
  ##  Start My Project
 ##

 # First install project using Composer
 composer create-project --prefer-dist laravel/laravel project-name


 # Config with Database

 # Install Breeze : It is used for the authentication of the pages as like as login, register, profile page etc.


 # Then use the SPATIE and run these command in cmd
 composer require spatie/laravel-permission
 php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
 php artisan optimize:clear
 or 
 php artisan config:clear

 # Run the migrations 
 php artisan migrate

 # create a new controller as Permission
 php artisan make:controller PermissionController

# add this in the Permission, Roles controller 
use Spatie\Permission\Models\Permission;

 # Get value from array 
 For example: $array = [{'id':1,'name':'a'},{'id':2,'name':'b'},{'id':3,'name':'c'},{'id':4,'name':'d'}];
 {{$array->pluck('name)->implode(', ')}}
 output => a,b,c
 implode use as get value from array and remove squre brackets. If you use with implode then show the output as [a,b,c].

 # add a new role in database and create a new model of articles
  php artisan make:model Article -m
Note: -m :: It is migrate a new table name as create_article_table.

# create a new controller name by Articles 
php artisan make:controller ArticlesController

# create a new controller name by User
php artisan make:controller UserController

# In user Controller : It is used for the list/Read and update data of user and add the role value of the users.

For example: function index() {
  $users = User::latest()->paginate(10);
}

# paginate :: used for the pagination in data table of read page
# latest() :: used for the get the data from database in latest order

# For Edit function
function edit($id) {
  $roles = Role::orderBy('name','ASC')->get();
}

# orderBy :: used for the sort the data in database
# ASC :: used for the sort the data in ascending order
# get :: used for the get the data from database


  