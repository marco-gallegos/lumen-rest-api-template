<?php

$api->get('permission', [
    'as' => 'permission.index',
    'uses' => 'PermissionController@index',
]);