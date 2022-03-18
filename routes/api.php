<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
$api = app('Dingo\Api\Routing\Router');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api->version('v1', function ($api) {
    // $api->get('users/{id}', );
});

$api->version('v1', function ($api) {
    $api->group(['middleware' => 'auth.api'], function ($api) {
     // Endpoints registered here will have the "auth" middleware applied.
        // $api->get('users/{id}', );
    });
});
