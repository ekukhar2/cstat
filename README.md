1) Create folder "eugen"(or other name) in folder "vendor". Copy source "cstat" to folder "vendor/eugen" or<br>
create folder "cstat" and clone from git:<br>
git init<br>
git pull https://github.com/ekukhar2/cstat.git<br>
<br>
2) Open your Laravel 5 application’s composer.json file and look for the "autoload" section. In "psr-4" insert the location to your package:<br>
"autoload": {<br>
"classmap": [<br>
"database"<br>
],<br>
"psr-4": {<br>
"App\\": "app/",<br>
"Eugen\\Cstat\\": "vendor/eugen/cstat/src"<br>
}<br>
},<br>



3) Open your application’s config/app.php file and add it to your providers and aliases<br>
'providers' => [<br>
...<br>
Eugen\Cstat\CstatServiceProvider::class,<br>
],<br>
<br>
'aliases' => [<br>
...<br>
'Cstat' => Eugen\Cstat\Facade\Cstat::class,<br>
],<br>
<br>
4)Open your application’s app/Http/Kernel.php file and add it to $middlewareGroups:<br>
protected $middlewareGroups = [<br>
'web' => [<br>
...<br>
\App\Http\Middleware\CstatMiddleware::class,<br>
],<br>
Also copy from there line:<br>
\Illuminate\Session\Middleware\StartSession::class,<br>
to $middleware:<br>
protected $middleware = [<br>
...<br>
\Illuminate\Session\Middleware\StartSession::class,<br>
];<br>
<br>
5) Run in command line:<br>
composer dump-autoload<br>
php artisan vendor:publish<br>
php artisan migrate<br>
php artisan make:seeder CstatcounterSeeder<br>
php artisan db:seed --class=CstatcounterSeeder<br>
<br>
6)You must also specify route names for collect page stats<br>
in web.php:<br>
Route::get('/', 'HomeController@index')->name('Home'); - will be working<br>
Route::post('/user', 'HomeController@update'); - will be skipped<br>
<br>
6) go to the link:<br>
your.site/cstat<br>
<br>
<br>
PS: If you wish protect cstat - go to the<br>
vendor/eugen/cstat/src/Controllers/CstatController.php<br>
and uncomment line<br>
//$this->middleware('auth');<br>
<br>

