<?php

use App\Http\Controllers\StarshipsController;
use App\Http\Controllers\VehiclesController;
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

// Starships
Route::get('starships', [StarshipsController::class, 'index']);
Route::get('starships/{id}', [StarshipsController::class, 'show']);
Route::put('starships/{id}/updateCount', [StarshipsController::class, 'updateCount']);
Route::put('starships/{id}/incrementCount', [StarshipsController::class, 'incrementCount']);
Route::put('starships/{id}/decrementCount', [StarshipsController::class, 'decrementCount']);

// Vehicles
Route::get('vehicles', [VehiclesController::class, 'index']);
Route::get('vehicles/{id}', [VehiclesController::class, 'show']);
Route::put('vehicles/{id}/updateCount', [VehiclesController::class, 'updateCount']);
Route::put('vehicles/{id}/incrementCount', [VehiclesController::class, 'incrementCount']);
Route::put('vehicles/{id}/decrementCount', [VehiclesController::class, 'decrementCount']);

/**
 * @OA\Get(
 *     path="/starships",
 *     summary="Obtener lista de naves espaciales",
 *     tags={"Starships"},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de naves espaciales",
 *     ),
 * )
 */