<?php

namespace App\Admin\Controllers;

use App\Models\Vet;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use App\Models\Utils;


class VetController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Vet & Paravet Registration';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Vet());

        $grid->filter(function ($f) {
            $f->disableIdFilter();
            $f->select('location_id', 'SubCounty')->options(\App\Models\Location::where('parent','!=',0)->pluck('name', 'id'));
            $f->like('category', 'Category');
            $f->like('group_or_practice', 'Group or practice');
            $f->between('created_at', 'Filter by date registered')->date();
        });

        //show a user only their records if they are not an admin
        if (!Admin::user()->inRoles(['administrator','ldf_admin'])) {
            $grid->model()->where('user_id', Admin::user()->id);
        }
        //disable batch actions
        $grid->disableBatchActions();

         //order of table
         $grid->model()->orderBy('id', 'desc');

         //disable action buttons appropriately
         Utils::disable_buttons('Vet', $grid);

        $grid->column('created_at', __('Registered On'))->display(function ($x) {
            $c = Carbon::parse($x);
        if ($x == null) {
            return $x; 
        }
        return $c->format('d M, Y');
        });
     
        $grid->column('profile_picture', __('Profile picture'))->image();
        $grid->column('title', __('Title'));
        $grid->column('category', __('Category'));
        $grid->column('surname', __('Surname'));
        $grid->column('primary_phone_number', __('Primary phone number'));
        $grid->column('email', __('Email'));
        $grid->column('services_offered', __('Services offered'));
        $grid->column('ares_of_operation', __('Areas of operation'));
        $grid->column('status', __('Status'))->display(function ($x) {
            if ($x == 'Approved') {
                return "<span class='badge badge-success'>$x</span>";
            } elseif ($x == 'Rejected') {
                return "<span class='badge badge-danger'>$x</span>";
            } elseif ($x == 'Halted') {
                return "<span class='badge badge-warning'>$x</span>";
            } else {
                return "<span class='badge badge-info'>$x</span>";
            }
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Vet::findOrFail($id));
        //delete notification after viewing the form
        Utils::delete_notification('Vet', $id);

        $show->file('profile_picture', __('Profile picture'));
        $show->field('title', __('Title'));
        $show->field('category', __('Category'));
        $show->field('surname', __('Surname'));
        $show->field('given_name', __('Given name'));
        $show->field('nin', __('Nin'));
        $show->field('physical_address', __('SubCounty'));
        $show->field('village', __('Village'));
        $show->field('parish', __('Parish'));
        $show->field('zone', __('Zone'));
        $show->field('group_or_practice', __('Group or practice'));
        $show->field('license_number', __('License number'));
        $show->field('license_expiry_date', __('License expiry date'));
        $show->field('date_of_registration', __('Date of registration'));
        $show->field('brief_profile', __('Brief profile'));
        $show->field('primary_phone_number', __('Primary phone number'));
        $show->field('secondary_phone_number', __('Alternative phone number'));
        $show->field('email', __('Email'));
        $show->field('postal_address', __('Postal address'));
        $show->field('services_offered', __('Services offered'));
        $show->field('ares_of_operation', __('Areas of operation'));
        $show->field('certificate_of_registration', __('Certificate of registration'))->file();
        $show->field('license', __('License'))->file();
        $show->field('other_documents', __('Other documents'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        //disable tools
        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableDelete();
        });
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Vet());

        if($form->isCreating()){
            $form->hidden('status')->default('Pending');
            $form->hidden('user_id')->default(Admin::user()->id);
        }

        $form->file('profile_picture', __('Profile picture'));
        $form->text('title', __('Title'))->rules('required');
        $form->radio('category', __('Category'))->options(['Vet' => 'Vet', 'Paravet' => 'Paravet'])->rules('required')->default('Vet');
        $form->text('surname', __('Surname'))->rules('required');
        $form->text('given_name', __('Given name'))->rules('required');
        $form->text('nin', __('Nin'))->rules('required');
        //  //add a get gps coordinate button
        //  $form->html('<button type="button" id="getLocationButton">' . __('Get GPS Coordinates') . '</button>');

        //  $form->text('coordinates', __('Location '))->attribute([
        //      'id' => 'coordinates',   
        //  ])->required();
      
         
        //  //script to get the gps coordinates
        //  Admin::script(<<<SCRIPT
        //      document.getElementById('getLocationButton').addEventListener('click', function() {
        //          if ("geolocation" in navigator) {
        //              navigator.geolocation.getCurrentPosition(function(position) {
        //                  document.getElementById('coordinates').value = position.coords.latitude + ', ' + position.coords.longitude;
        //              });
        //          } else {
        //              alert('Geolocation is not supported by your browser.');
        //          }
        //      });
        //  SCRIPT);
        $form->text('coordinates', __('Physical Address '))->required();
        $form->select('location_id', __('District SubCounty'))->options(\App\Models\Location::where('parent','!=',0)->pluck('name', 'id'))->rules('required');
        $form->text('village', __('Village'));
        $form->text('parish', __('Parish'));
        $form->text('zone', __('Zone'));
        $form->text('group_or_practice', __('Group or practice'))->rules('required');
        $form->text('license_number', __('License number'))->rules('required');
        $form->date('license_expiry_date', __('License expiry date'))->rules('required');
        $form->date('date_of_registration', __('Date of registration'))->rules('required');
        $form->textarea('brief_profile', __('Brief profile'));
        $form->text('primary_phone_number', __('Primary phone number'))->rules('required');
        $form->text('secondary_phone_number', __('Alternative phone number'));
        $form->email('email', __('Email'))->rules('required');
        $form->text('postal_address', __('Postal address'));
        $form->textarea('services_offered', __('Services offered'))->rules('required');
        $form->text('ares_of_operation', __('Areas of operation'))->rules('required');
        $form->file('certificate_of_registration', __('Certificate of registration'))->rules('required');
        $form->file('license', __('License'))->rules('required');
        $form->multipleFile('other_documents', __('Other documents'));

        //check if the user is an admin and show the status field
        if (Admin::user()->inRoles(['administrator','ldf_admin'])) {
            $form->radioCard('status', __('Status'))->options(['halted' => 'Halted', 'approved' => 'Approved', 'rejected' => 'Rejected'])->rules('required');
        }

        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
           
        });

        return $form;
    }
}
