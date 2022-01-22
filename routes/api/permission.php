<?php

$api->get('permission', [
    'as' => 'permission.index',
    'uses' => 'PermissionController@index',
]);

$api->post('permission', [
    'as' => 'permission.store',
    'uses' => 'PermissionController@store',
]);

$api->post('permission/grant', [
    'as' => 'permission.grant',
    'uses' => 'PermissionController@grant',
]);

$api->delete('permission/revoke/{user_id}/{permission_id}', [
    'as' => 'permission.revoke',
    'uses' => 'PermissionController@revoke',
]);

$api->get('permission/{permission_id}', [
    'as' => 'permission.show',
    'uses' => 'PermissionController@show',
]);

$api->delete('/permission/{permission_id}', [
    'as' => 'permission.delete',
    'uses' => 'PermissionController@revoke',
]);