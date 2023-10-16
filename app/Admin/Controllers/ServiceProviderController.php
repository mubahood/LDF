<?php

namespace App\Admin\Controllers;

use App\Models\ServiceProvider;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;


class ServiceProviderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ServiceProvider';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ServiceProvider());

        $grid->column('id', __('Id'));
        $grid->column('logo', __('Logo'))->image();
        $grid->column('name', __('Name'));
        $grid->column('owner_name', __('Owner name'));
        $grid->column('owner_profile', __('Owner profile'));
        $grid->column('class_of_service', __('Class of service'));
        $grid->column('date_of_registration', __('Date of registration'));
        $grid->column('physical_address', __('Physical address'));
        $grid->column('primary_phone_number', __('Primary phone number'));
        $grid->column('secondary_phone_number', __('Secondary phone number'));
        $grid->column('email', __('Email'));
        $grid->column('postal_address', __('Postal address'));
        $grid->column('other_services', __('Other services'));
        $grid->column('distroict_of_operation', __('District of operation'));
        // $grid->column('NDA_registration_number', __('NDA registration number'));
        $grid->column('tin_number_business', __('Tin number business'));
        $grid->column('tin_number_owner', __('Tin number owner'));
        $grid->column('created_at', __('Created at'))->display(function ($x) {
            $c = Carbon::parse($x);
        if ($x == null) {
            return $x;
        }
        return $c->format('d M, Y');
        });
        $grid->column('updated_at', __('Updated at'))->display(function ($x) {
            $c = Carbon::parse($x);
        if ($x == null) {
            return $x;
        }
        return $c->format('d M, Y');
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
        $show = new Show(ServiceProvider::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('owner_name', __('Owner name'));
        $show->field('owner_profile', __('Owner profile'));
        $show->field('class_of_service', __('Class of service'));
        $show->field('date_of_registration', __('Date of registration'));
        $show->field('physical_address', __('Physical address'));
        $show->field('primary_phone_number', __('Primary phone number'));
        $show->field('secondary_phone_number', __('Secondary phone number'));
        $show->field('email', __('Email'));
        $show->field('postal_address', __('Postal address'));
        $show->field('other_services', __('Other services'));
        $show->field('logo', __('Logo'));
        $show->field('distroict_of_operation', __('Distroict of operation'));
        $show->field('NDA_registration_number', __('NDA registration number'));
        $show->field('tin_number_business', __('Tin number business'));
        $show->field('tin_number_owner', __('Tin number owner'));
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
        $form = new Form(new ServiceProvider());

        $form->text('name', __('Name'))->rules('required');
        $form->text('owner_name', __('Owner name'))->rules('required');
        $form->textarea('owner_profile', __('Owner profile'))->rules('required');
        $form->textarea('class_of_service', __('Class of service'))->rules('required');
        $form->date('date_of_registration', __('Date of registration'))->rules('required|before_or_equal:today');
        $form->text('physical_address', __('Physical address'))->rules('required');
        $form->text('primary_phone_number', __('Primary phone number'))->rules('required');
        $form->text('secondary_phone_number', __('Secondary phone number'));
        $form->email('email', __('Email'));
        $form->text('postal_address', __('Postal address'));
        $form->text('other_services', __('Other services'));
        $form->image('logo', __('Logo'));
        $form->text('distroict_of_operation', __('District of operation'))->help('District of operation - sub county')->rules('required');
        $form->text('tin_number_business', __('Tin number business'))->rules('required');
        $form->text('tin_number_owner', __('Tin number owner'))->rules('required');
        $form->file('NDA_registration_number', __('NDA registration number'))->rules('required');
        $form->file('license', __('License'))->rules('required');
        $form->multipleFile('other_documents', __('Other documents'));

        return $form;
    }
}
