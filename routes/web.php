<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmActivityController;
use App\Admin\Controllers\HomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and assigned to the "web" middleware group.
| Now create something great!
|
*/

Route::view('auth/register', 'auth.register');

// routes/web.php

    Route::get('/health', function (Request $request) {
        $filter = $request->input('filter', 'day'); // Default filter is day

        $startDate = now()->sub($filter, 1); // Adjust the start date based on the selected filter

        $userCounts = DB::table('admin_operation_log')
            ->where('created_at', '>=', $startDate)
            ->groupBy('user_id')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s')"))
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as time"),
                DB::raw('COUNT(user_id) as user_count')
            )
            ->get();

        dd($userCounts);
    });



Route::get('/calendar', [FarmActivityController::class, 'index'])->name('event.index');
Route::post('/calendar/events', [FarmActivityController::class, 'store'])->name('event.store');
Route::get('/user-activity', [HomeController::class, 'index'])->name('user-activity');
Route::get('/financial-summary-data', [HomeController::class, 'index'])->name('financial-summary-data');

