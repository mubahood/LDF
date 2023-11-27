<?php

namespace App\Admin\Controllers;

use App\Models\Vet;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;


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

        $grid->model()->latest();

        $grid->column('created_at', __('Registered On'))->display(function ($x) {
            $c = Carbon::parse($x);
        if ($x == null) {
            return $x; 
        }
        return $c->format('d M, Y');
        });
        // $grid->column('id', __('Id'));
        $grid->column('profile_picture', __('Profile picture'))->image();
        $grid->column('title', __('Title'));
        $grid->column('category', __('Category'));
        $grid->column('surname', __('Surname'));
        $grid->column('given_name', __('Given name'));
        $grid->column('nin', __('Nin'));
        $grid->location()->name('SubCounty');
        $grid->column('village', __('Village'));
        $grid->column('parish', __('Parish'));
        $grid->column('zone', __('Zone'));
        $grid->column('group_or_practice', __('Group or practice'));
        $grid->column('license_number', __('License number'));
        $grid->column('license_expiry_date', __('License expiry date'));
        $grid->column('date_of_registration', __('Date of registration'));
        $grid->column('brief_profile', __('Brief profile'));
        $grid->column('primary_phone_number', __('Primary phone number'));
        $grid->column('secondary_phone_number', __('Alternative phone number'));
        $grid->column('email', __('Email'));
        $grid->column('postal_address', __('Postal address'));
        $grid->column('services_offered', __('Services offered'));
        $grid->column('ares_of_operation', __('Areas of operation'));

        // $grid->column('updated_at', __('Updated at'))->display(function ($x) {
        //     $c = Carbon::parse($x);
        // if ($x == null) {
        //     return $x;
        // }
        // return $c->format('d M, Y');
        // });

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

        $show->field('id', __('Id'));
        $show->field('profile_picture', __('Profile picture'));
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
        $show->field('certificate_of_registration', __('Certificate of registration'));
        $show->field('license', __('License'));
        $show->field('other_documents', __('Other documents'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

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

        $form->image('profile_picture', __('Profile picture'));
        $form->text('title', __('Title'))->rules('required');
        $form->radio('category', __('Category'))->options(['Vet' => 'Vet', 'Paravet' => 'Paravet'])->rules('required')->default('Vet');
        $form->text('surname', __('Surname'))->rules('required');
        $form->text('given_name', __('Given name'))->rules('required');
        $form->text('nin', __('Nin'))->rules('required');
        $form->text('coordinates', __('Coordinates'))->placeholder('lat, lng')->help('e.g. 0.000000, 0.000000');
        $form->select('location_id', __('SubCounty'))->options(\App\Models\Location::where('parent','!=',0)->pluck('name', 'id'))->rules('required');
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

        return $form;
    }
}
