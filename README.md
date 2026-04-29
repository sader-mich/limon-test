# limon
Sistema para trazabilidad del limon en el Estado de Michoacan

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

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Storage
*Powershell con admin

rmdir C:\xampp\htdocs\limon\public\storage

New-Item -ItemType SymbolicLink -Path C:\xampp\htdocs\limon\public\storage -Target C:\xampp\htdocs\limon\storage\app\public

*En CMD verificar ( 07/25/2024  05:32 PM    <SYMLINKD>     storage [..\storage\app\public] )
dir C:\xampp\htdocs\limon\public

# Spatie Activitylog
composer require spatie/laravel-activitylog
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
php artisan migrate

$serie = Serie::create($input);
activity()
    ->performedOn($serie)
    ->causedBy(Auth::user()->id)
    ->withProperties(['attributes' => $serie->attributesToArray()])
    ->log('Se agrego una nueva serie');

## Consola

sudo chmod -R 777 /var/www/estadisticas


https://www.allphptricks.com/laravel-11-spatie-user-roles-and-permissions/
https://www.allphptricks.com/simple-laravel-10-user-roles-and-permissions/

# Nuevo proyecto

composer create-project --prefer-dist laravel/laravel:^11 name_proyect

# .env Cambiar el nombre de la base de datos

composer require laravel/ui

php artisan ui bootstrap --auth
php artisan ui vue --auth

npm install

npm run build

composer require spatie/laravel-permission

# Add middleware boostrap/app.php

$middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        ]);

Add middleware boostrap/providers.php

<?php

return [
    App\Providers\AppServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
];


php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

php artisan make:model Product -mcr --requests

php artisan make:seeder PermissionSeeder
php artisan make:seeder RoleSeeder
php artisan make:seeder SuperAdminSeeder

app/Providers/AppServiceProvider

public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Administrador') ? true : null;
        });
        Paginator::useBootstrapFive();
    }


php artisan make:controller RoleController --resource
php artisan make:controller UserController --resource
php artisan make:request StoreRoleRequest
php artisan make:request UpdateRoleRequest
php artisan make:request StoreUserRequest
php artisan make:request UpdateUserRequest

routes/web

php artisan make:view users.index
php artisan make:view users.create
php artisan make:view users.edit
php artisan make:view users.show
php artisan make:view roles.index
php artisan make:view roles.create
php artisan make:view roles.edit
php artisan make:view roles.show
php artisan make:view products.index
php artisan make:view products.create
php artisan make:view products.edit
php artisan make:view products.show

composer require laravel/sanctum
php artisan install:api

php artisan serve

php artisan migrate:fresh --seed
php artisan migrate:refresh --path=/database/migrations/2024_06_07_183140_create_informes_table.php

php artisan migrate --path=/database/migrations/2024_11_22_202238_create_activity_log_table.php

php artisan make:controller RoleController --resource
php artisan make:controller UserController --resource

php artisan make:request StoreRoleRequest
php artisan make:request UpdateRoleRequest

php artisan make:view users.index
php artisan make:view users.create
php artisan make:view users.edit
php artisan make:view users.show

rm 'INFORME_Georgina Gutierrez Lopez_2024-JUNIO_20240617_174401.pdf' 'INFORME_Georgina Gutierrez Lopez_2024-JUNIO_20240617_174907.pdf' 

php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Laravel JSValidation
composer require proengsoft/laravel-jsvalidation
php artisan vendor:publish --provider="Proengsoft\JsValidation\JsValidationServiceProvider"

En config/jsvalidation.php
'view' => 'jsvalidation::bootstrap5',

En .gitignore
/resources/views/vendor/
/public/vendor/

# Custom Alerts
composer require php-flasher/flasher-notyf-laravel
https://php-flasher.io/library/notyf/

notyf()
    ->position('y', 'top')
    ->addError('Seleccione un tomo para poder eliminar');
    return redirect()->back();

notyf()
    ->position('y', 'top')
    ->addSuccess('Tomo eliminado correctamente');
    return redirect()->back();

# Trait "Laravel\Sanctum\HasApiTokens" not found
composer require laravel/sanctum

# Instalar laravel 11
composer create-project laravel/laravel:^11.0 proyecto-sader
cd proyecto-sader
php artisan serve

# Instalar Laravel Spatie
composer require spatie/laravel-permission

En boostrap/providers.php
return [
    // ...
    Spatie\Permission\PermissionServiceProvider::class,
];

In Laravel 11 open /bootstrap/app.php and register them there:

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })


php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# Añadir roles y permisos en el middleware
En boostrap/app.php
->withMiddleware(function (Middleware $middleware) {
    // ...
    $middleware->alias(['role' => \Spatie\Permission\Middleware\RoleMiddleware::class]);
    $middleware->alias(['permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class]);
    $middleware->alias(['role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class]);
})

# Crear el crud de Archivo
php artisan make:model Archivo -mcr --requests

# Instalar Laravel Sanctum
php artisan install:api

# Añadir Spatie Traits el modelo de User
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;
    // ...
}

## Opcional: Añadir username para login con username en vez de correo
protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];


# Crear los seeders
php artisan make:seeder PermissionSeeder
php artisan make:seeder RoleSeeder
php artisan make:seeder AdminSeeder

## Actuallizar DatabaseSeeder
public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
        ]);
    }

# Configurar la base de datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# Migrar los datos
php artisan migrate:refresh --seed

# Definiendo el Admin
En app/Providers/AppServiceProvider.php

// ...
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;

public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin') ? true : null;
        });
        Paginator::useBootstrapFive();
    }

# Laravel Bootstrap Auth Scaffolding
composer require laravel/ui
php artisan ui bootstrap --auth
npm install
npm run dev

# Config files
php artisan config:publish
hashing
cors
broadcasting
view

# Laravel JSValidation
composer require proengsoft/laravel-jsvalidation
php artisan vendor:publish --provider="Proengsoft\JsValidation\JsValidationServiceProvider"

En config/jsvalidation.php
'view' => 'jsvalidation::bootstrap5',

En .gitignore
/resources/views/vendor/
/public/vendor/

## Opcional Hidden Elements
'ignore' => "[contenteditable='true']",

# Laravel Excel
composer require maatwebsite/excel

En bootstrap/providers.php
return [
    // ...
    Maatwebsite\Excel\ExcelServiceProvider::class,
];

php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config

# Cambiar username por email en la verificacion
https://dev.to/shanisingh03/how-to-login-with-username-instead-of-email-in-laravel--hj8
php artisan make:migration add_username_field_in_users_table

public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('username')->after('name');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('username');
    });
}


# 404 Paginas
php artisan vendor:publish --tag=laravel-errors

# Laravel Lang
Eliminar el directorio de lang
composer require --dev laravel-lang/common
php artisan lang:add es

En .env
APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=es_MX

En config/app.php
'locale' => env('APP_LOCALE', 'es'),

'fallback_locale' => env('APP_FALLBACK_LOCALE', 'es'),

'faker_locale' => env('APP_FAKER_LOCALE', 'es_MX'),

En composer.json
{
    "scripts": {
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=laravel-assets --ansi --force",
            "@php artisan lang:update"
        ]
    }
}

# Database Collation
En config/database.php
'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),

# Broadcasting
php artisan install:broadcasting
composer require pusher/pusher-php-server

# Laravel CORS
En boostrap/app.php
->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            // \Illuminate\Http\Middleware\TrustHosts::class,
            \Illuminate\Http\Middleware\TrustProxies::class,
            \Illuminate\Http\Middleware\HandleCors::class,
            \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
            \Illuminate\Http\Middleware\ValidatePostSize::class,
            \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        ]);

        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
        ]);

        $middleware->group('api', [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // 'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        $middleware->alias([
             // ...
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
            'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ]);
})

# DataTables
## Idioma
https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-MX.json

# Subir a servidor
En .env
APP_URL=http://10.8.30.232

En config/app.php
'url' => env('APP_URL', 'http://10.8.30.232'),

En resources/views/layouts/app.blade.php
form hidden id="searchform" method="get" action="http://10.8.30.232 search"

# Spatie Activitylog
composer require spatie/laravel-activitylog
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
php artisan migrate

$serie = Serie::create($input);
activity()
    ->performedOn($serie)
    ->causedBy(Auth::user()->id)
    ->withProperties(['attributes' => $serie->attributesToArray()])
    ->log('Se agrego una nueva serie');

# Custom Alerts
composer require php-flasher/flasher-notyf-laravel
https://php-flasher.io/library/notyf/

notyf()
    ->position('y', 'top')
    ->addError('Seleccione un tomo para poder eliminar');
    return redirect()->back();

notyf()
    ->position('y', 'top')
    ->addSuccess('Tomo eliminado correctamente');
    return redirect()->back();


# QR Code
composer require simplesoftwareio/simple-qrcode

# Imagen
composer require intervention/image

# Storege:link reset

cd proyecto
ls -l public/storage
rm -rf public/storage
php artisan storage:link

# Wordpress

http://10.8.30.231/wp-login.php?redirect_to=http%3A%2F%2F10.8.30.231%2Fwp-admin%2F&reauth=1

# ZDescargas
https://www.zdescargas.org/zebra-cardstudio-professional-2022-full-espanol-mega/

# Guia grafica
https://michoacan.gob.mx/guia-grafica/

# Icons
https://fontawesome.com/v5/search?ic=free

<IfModule mod_rewrite.c>
    RewriteEngine On

    # Redirige HTTP a HTTPS en producción
    # Descomenta las siguientes líneas si necesitas redirección a HTTPS
    # RewriteCond %{HTTPS} off
    # RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

    # Sirve la subruta /limon correctamente
    # Ajusta esta línea si tu aplicación reside en una subruta diferente
    RewriteBase /limon/

    # Redirige las solicitudes al front controller (index.php) si no es un archivo real o directorio
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ index.php [L]
</IfModule>

# Si usas Apache 2.4, también podrías necesitar esto para permitir el acceso a los recursos
<IfModule mod_authz_core.c>
    Require all granted
</IfModule>
