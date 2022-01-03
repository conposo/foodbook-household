<?php

// use \app\Http\Controllers\HouseholdController;
// use \app\Http\Controllers\HouseholdMembersController;

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('household/{user_id}', 'HouseholdController@store');
$router->get('household/{id}', 'HouseholdController@index');

$router->get('household-members/{user_id}', 'HouseholdMembersController@show');
$router->patch('household/{household_id}', 'HouseholdController@update');

$router->post('member/{user_id}', 'HouseholdMembersController@store');
$router->delete('member', 'HouseholdMembersController@destroy');
$router->patch('member/{member_id}', 'HouseholdMembersController@update');

// System
$router->get('allhouseholds', 'SystemController@allhouseholds');
$router->get('allmembers', 'SystemController@allmembers');