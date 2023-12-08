<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmActivityController;
use App\Models\AnimalHealthRecord;

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
    $healthRecords = AnimalHealthRecord::all();
        $timestamps = $healthRecords->pluck('date');
        $healthStatus = $healthRecords->pluck('status');

      

        return view('livestock_health_chart', ['timestamps' => $timestamps, 'healthStatus' => $healthStatus]);
});

Route::get('/calendar', [FarmActivityController::class, 'index'])->name('event.index');
Route::post('/calendar/events', [FarmActivityController::class, 'store'])->name('event.store');

