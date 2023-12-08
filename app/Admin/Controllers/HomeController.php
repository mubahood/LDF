<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Admin;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title(__('Dashboard'))
            ->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->append(Dashboard::liveStockHealth());
                });
           
            })

            ->row(function (Row $row) {
                 $row->column(12, function (Column $column) {
                     $column->append(Dashboard::livestockBreed());
                 });
             })

            ->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->append(Dashboard::productionMetrics());
                });
            });
     
    
    }

  

}
