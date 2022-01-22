<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */
$apiVersion = "v1";
$api = app('Dingo\Api\Routing\Router');

// v1 version API
$api->version($apiVersion, [
    'namespace'     => 'App\Http\Controllers\Api\V1',
    'middleware'    => [
        'cors',
        'serializer',
        //'serializer:array', // if you want to remove data wrap
        //'api.throttle',
    ],
    // each route have a limit of 20 of 1 minutes
    'limit'         => 20,
    'expires'       => 1,
    'prefix'        => "api/{$apiVersion}"
], function ($api) {    
    // Auth
    // login
    $api->post('authorizations', [
        'as' => 'authorizations.store',
        'uses' => 'AuthController@store',
    ]);

    /**
     * For authorizations is not saved in the database, so there is no id, then for
     * Refresh and delete (delete) I didn't think of a better way of naming
     * So for the time being, authorizations/current represents the token in the current header.
     * If tokekn save is stored in the database, then it is authorizations/{id}, like github.
     */
    $api->put('authorizations/current', [
        'as' => 'authorizations.update',
        'uses' => 'AuthController@update',
        ]);
        
    // need authentication
    $api->group(['middleware' => 'api.auth'], function ($api) {
        require("user.php");
        require("permission.php");
    });
});
