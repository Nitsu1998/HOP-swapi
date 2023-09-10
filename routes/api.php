<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('{type}', 'InventoryController@index')->middleware('validateResourceType');
Route::get('{type}/{id}', 'InventoryController@show')->middleware('validateResourceType');
Route::put('{type}/{id}/setCount', 'InventoryController@updateCount')->middleware('validateResourceType');
Route::put('{type}/{id}/incrementCount', 'InventoryController@incrementCount')->middleware('validateResourceType');
Route::put('{type}/{id}/decrementCount', 'InventoryController@decrementCount')->middleware('validateResourceType');

