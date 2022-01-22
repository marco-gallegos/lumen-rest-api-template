<?php

// User
$api->post('users', [
    'as' => 'users.store',
    'uses' => 'UserController@store',
]);
// user list
$api->get('users', [
    'as' => 'users.index',
    'uses' => 'UserController@index',
]);
// user detail
$api->get('users/{id}', [
    'as' => 'users.show',
    'uses' => 'UserController@show',
]);

$api->delete('authorizations/current', [
    'as' => 'authorizations.destroy',
    'uses' => 'AuthController@destroy',
]);

// my detail
$api->get('user', [
    'as' => 'user.show',
    'uses' => 'UserController@userShow',
]);

// update part of me
$api->patch('user', [
    'as' => 'user.update',
    'uses' => 'UserController@patch',
]);
// update my password
$api->put('user/password', [
    'as' => 'user.password.update',
    'uses' => 'UserController@editPassword',
]);