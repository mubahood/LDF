<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmActivityController;

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

Route::get('/calendar', [FarmActivityController::class, 'index'])->name('event.index');
Route::post('/calendar/events', [FarmActivityController::class, 'store'])->name('event.store');

