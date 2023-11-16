<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Admin;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $farmers = \App\Models\Farmer::count();
        $cooperatives = \App\Models\Cooperative::count();
        $farms = \App\Models\Farm::count();
        $vets = \App\Models\Vet::count();
        Admin::js('/adminlte/dist/js/pages/dashboard.js');

        return $content
            ->title('Dashboard')
            ->description('Welome to the Farm Management System')
            ->view('dashboards.index', compact('farmers', 'cooperatives', 'farms', 'vets'));
        
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
