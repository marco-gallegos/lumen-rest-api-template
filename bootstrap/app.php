<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

// phpunit 
$app->withFacades();

$app->withEloquent();

//config
// jwt
$app->configure('jwt');
// api
$app->configure('api');

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

$app->configure('app');

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware([
    //set language accept-language
    'locale' => App\Http\Middleware\ChangeLocale::class,
]);

$app->routeMiddleware([
    'cors' => palanik\lumen\Middleware\LumenCors::class,
    'auth' => App\Http\Middleware\Authenticate::class,
    'serializer' => \Liyu\Dingo\SerializerSwitch::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// dingo/api
$app->register(Dingo\Api\Provider\LumenServiceProvider::class);
//jwt
$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
//$app->register(Illuminate\Redis\RedisServiceProvider::class);
//$app->register(App\Providers\EventServiceProvider::class);

//app('Dingo\Api\Auth\Auth')->extend('jwt', function ($app) {
    //return new Dingo\Api\Auth\Provider\JWT($app['Tymon\JWTAuth\JWTAuth']);
//});

// Injecting auth
$app->singleton(Illuminate\Auth\AuthManager::class, function ($app) {
    return $app->make('auth');
});

//algunos comandos de laravel
if(class_exists(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class)){
    $app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);
}


/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/api/v1.php';
    require __DIR__.'/../routes/web.php';
});

return $app;
