<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Admin;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $farmers = \App\Models\Farmer::count();
        $cooperations = \App\Models\Cooperation::count();
        $farms = \App\Models\Farm::count();
        $vets = \App\Models\Vet::count();
        Admin::js('/adminlte/dist/js/pages/dashboard.js');

        return $content
            ->title('Dashboard')
            ->description('Welome to the Farm Management System')
            ->view('dashboards.index', compact('farmers', 'cooperations', 'farms', 'vets'));
        
        // return $content
        //     ->title('Dashboard')
        //     ->description('Description...')
        //     ->row(Dashboard::title())
        //     ->row(function (Row $row) {

        //         $row->column(4, function (Column $column) {
        //             $column->append(Dashboard::environment());
        //         });

        //         $row->column(4, function (Column $column) {
        //             $column->append(Dashboard::extensions());
        //         });

        //         $row->column(4, function (Column $column) {
        //             $column->append(Dashboard::dependencies());
        //         });
        //     });
    
    }

    // protected $title = 'Dashboard';

    // protected $description = 'Welome to the Farm Management System';

    // protected function grid()
    // {
    //     return view('dashboards.index');
    // }

}
