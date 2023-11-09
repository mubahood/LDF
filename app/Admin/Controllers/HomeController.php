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

        Admin::js('/adminlte/plugins/jQuery/jQuery-2.1.4.min.js');
        // jQuery UI 1.11.4 -->
        Admin::js('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js');
        // Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        // <script>
        //   $.widget.bridge('uibutton', $.ui.button);
        // </script>
        // Bootstrap 3.3.5 -->
        Admin::js('/adminlte/bootstrap/js/bootstrap.min.js');
        // Morris.js charts -->
        Admin::js('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js');
        Admin::js('/adminlte/plugins/morris/morris.min.js');
        // Sparkline -->
        Admin::js('/adminlte/plugins/sparkline/jquery.sparkline.min.js');
        // jvectormap -->
        Admin::js('/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');
        Admin::js('/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');
        // jQuery Knob Chart -->
        Admin::js('/adminlte/plugins/knob/jquery.knob.js');
        // daterangepicker -->
        Admin::js('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js');
        Admin::js('/adminlte/plugins/daterangepicker/daterangepicker.js');
        // datepicker -->
        Admin::js('/adminlte/plugins/datepicker/bootstrap-datepicker.js');
        // Bootstrap WYSIHTML5 -->
        Admin::js('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
        // Slimscroll -->
        Admin::js('/adminlte/plugins/slimScroll/jquery.slimscroll.min.js');
        // FastClick -->
        Admin::js('/adminlte/plugins/fastclick/fastclick.js');
        // AdminLTE App -->
        Admin::js('/adminlte/dist/js/app.min.js');
        // AdminLTE dashboard demo (This is only for demo purposes) -->
        Admin::js('/adminlte/dist/js/pages/dashboard.js');
        // AdminLTE for demo purposes -->
        Admin::js('/adminlte/dist/js/demo.js');

        // Bootstrap 3.3.5 -->
        Admin::css('/adminlte/bootstrap/css/bootstrap.min.css');
        // Font Awesome -->
        Admin::css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
        // Ionicons -->
        Admin::css('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
        // Theme style -->
        Admin::css('/adminlte/dist/css/AdminLTE.min.css');
        // AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        Admin::css('/adminlte/dist/css/skins/_all-skins.min.css');
        // iCheck -->
        Admin::css('/adminlte/plugins/iCheck/flat/blue.css');
        // Morris chart -->
        Admin::css('/adminlte/plugins/morris/morris.css');
        // jvectormap -->
        Admin::css('/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css');
        // Date Picker -->
        Admin::css('/adminlte/plugins/datepicker/datepicker3.css');
        // Daterange picker -->
        Admin::css('/adminlte/plugins/daterangepicker/daterangepicker-bs3.css');
        // bootstrap wysihtml5 - text editor -->
        Admin::css('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
        
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
