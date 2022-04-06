<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPaswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Dingo\Api\Routing\Router;
/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth',], function () use ($api){
        $api->get('/', function(){
            return json_encode("Auth home page returned");
        });
        $api->post('/signUp', [AuthController::class, 'signUp']);
        $api->post('/signIn', [AuthController::class, 'signIn']);
        $api->post('/reset_password_request', [AuthController::class, 'resetPasswordRequest']);
        $api->post('/reset_password', [AuthController::class, 'resetPassword']);


    // Endpoints registered here will have the "auth" middleware applied.
        $api->group(['middleware' => 'auth.api'], function ($api) {
            $api->get('/logout', [AuthController::class, 'logout']);
        });
    });
});



