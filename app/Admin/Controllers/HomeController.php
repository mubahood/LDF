<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public static function userMetrics(Request $request)
    {
        $filter = $request->input('filter', 'day'); // Default filter is day
    
        $startDate = now()->sub($filter, 1); // Adjust the start date based on the selected filter
    
        $userCounts = DB::table('admin_operation_log')
            ->where('created_at', '>=', $startDate)
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as time"),
                DB::raw('COUNT(DISTINCT user_id) as user_count') // Count distinct user_ids for each day
            )
            ->get();
    
        return view('user_activity_chart', compact('userCounts', 'filter'));
    }
    

    public function index(Content $content)
    {
        return $content
            ->title(__('Dashboard'))
            ->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->append(Dashboard::liveStockHealth());
                });
           
            })

            // ->row(function (Row $row) {
            //      $row->column(12, function (Column $column) {
            //          $column->append(Dashboard::livestockBreed());
            //      });
            //  })

            // ->row(function (Row $row) {
            //     $row->column(12, function (Column $column) {
            //         $column->append(Dashboard::productionMetrics());
            //     });
            // })

            ->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->append($this->userMetrics(request()));
                });
            });


     
    
    }

  

}
