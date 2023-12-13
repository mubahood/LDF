<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalHealthRecordController;
use App\Http\Controllers\BreedController;
use App\Http\Controllers\CooperativeController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FarmActivityApiController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\FinancialRecordController;
use App\Http\Controllers\LivestockTypeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductionRecordController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\VectorAndDiseaseController;
use App\Http\Controllers\VetsController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('test', [AuthController::class, 'index']);
Route::post('register', [AuthController::class, 'register']);
Route::get('profile', [AuthController::class, 'profile']);
Route::post('login', [AuthController::class, 'login']);

Route::resource('animals', AnimalController::class);
Route::resource('animal-health-records', AnimalHealthRecordController::class);
Route::resource('breeds', BreedController::class);
Route::resource('cooperatives', CooperativeController::class);
Route::resource('farms', FarmController::class);
Route::resource('farm-activities', FarmActivityApiController::class);
Route::resource('farmers', FarmerController::class);
Route::resource('financial-records', FinancialRecordController::class);
Route::resource('livestock-types', LivestockTypeController::class);
Route::resource('locations', LocationController::class);
Route::resource('notifications', NotificationController::class);
Route::resource('production-records', ProductionRecordController::class);
Route::resource('service-providers', ServiceProviderController::class);
Route::resource('vectors-and-diseases', VectorAndDiseaseController::class);
Route::resource('vets', VetsController::class);
