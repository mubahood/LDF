<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmActivityController;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::view('auth/register', 'auth.register');
// routes/web.php
Route::get('/health', function () {
    $data = DB::table('production_records')
    ->join('farms', 'production_records.farm_id', '=', 'farms.id')
    ->join('breeds', 'production_records.breed_id', '=', 'breeds.id')
    ->select( 'breeds.name as breed_name', 'farms.name as farm_name', 'production_records.created_at as date', 'production_records.daily_weight_gain as weight')
    ->groupBy( 'breeds.name', 'farms.name', 'production_records.created_at', 'production_records.daily_weight_gain')
    ->get();

            dd($data);

});

Route::get('/calendar', [FarmActivityController::class, 'index'])->name('event.index');
Route::post('/calendar/events', [FarmActivityController::class, 'store'])->name('event.store');

