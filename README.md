1) Create folder "eugen"(or other name) in folder "vendor". Copy source "cstat" to folder "vendor/eugen"

2) Open your Laravel 5 application’s composer.json file and look for the "autoload" section. In "psr-4" insert the location to your package:
"autoload": {
"classmap": [
"database"
],
"psr-4": {
"App\\": "app/",
"Eugen\\Cstat\\": "vendor/eugen/cstat/src"
}
},



3) Open your application’s config/app.php file and add it to your providers and aliases
'providers' => [
...
Eugen\Cstat\CstatServiceProvider::class,
],

'aliases' => [
...
'Cstat' => Eugen\Cstat\Facade\Cstat::class,
],

4)Open your application’s app/Http/Kernel.php file and add it to $middlewareGroups:
protected $middlewareGroups = [
'web' => [
...
\App\Http\Middleware\CstatMiddleware::class,
],
Also copy from there line:
\Illuminate\Session\Middleware\StartSession::class,
to $middleware:
protected $middleware = [
...
\Illuminate\Session\Middleware\StartSession::class,
];

5) Run in command line:
php artisan vendor:publish
php artisan migrate
php artisan make:seeder CstatcounterSeeder
php artisan db:seed --class=CstatcounterSeeder

6) Run in command line:
composer dump-autoload

