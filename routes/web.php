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
    $data = DB::table('locations')
    ->join('farms', 'locations.id', '=', 'farms.location_id')
    ->join('breed_farm', 'farms.id', '=', 'breed_farm.farm_id')
    ->join('breeds', 'breed_farm.breed_id', '=', 'breeds.id')
    ->select('locations.name as location_name', 'breeds.name as breed_name', DB::raw('COUNT(*) as breed_count'))
    ->groupBy('locations.name', 'breeds.name')
    ->get();
            dd($data);

});

Route::get('/calendar', [FarmActivityController::class, 'index'])->name('event.index');
Route::post('/calendar/events', [FarmActivityController::class, 'store'])->name('event.store');

