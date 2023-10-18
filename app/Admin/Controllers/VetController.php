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
    protected $title = 'Vet';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Vet());

        $grid->column('id', __('Id'));
        $grid->column('profile_picture', __('Profile picture'))->image();
        $grid->column('title', __('Title'));
        $grid->column('surname', __('Surname'));
        $grid->column('given_name', __('Given name'));
        $grid->column('nin', __('Nin'));
        $grid->column('physical_address', __('Physical address'));
        $grid->column('group_or_practice', __('Group or practice'));
        $grid->column('license_number', __('License number'));
        $grid->column('license_expiry_date', __('License expiry date'));
        $grid->column('date_of_registration', __('Date of registration'));
        $grid->column('brief_profile', __('Brief profile'));
        $grid->column('primary_phone_number', __('Primary phone number'));
        $grid->column('secondary_phone_number', __('Secondary phone number'));
        $grid->column('email', __('Email'));
        $grid->column('postal_address', __('Postal address'));
        $grid->column('services_offered', __('Services offered'));
        $grid->column('ares_of_operation', __('Ares of operation'));
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
        $show = new Show(Vet::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('profile_picture', __('Profile picture'));
        $show->field('title', __('Title'));
        $show->field('surname', __('Surname'));
        $show->field('given_name', __('Given name'));
        $show->field('nin', __('Nin'));
        $show->field('physical_address', __('Physical address'));
        $show->field('group_or_practice', __('Group or practice'));
        $show->field('license_number', __('License number'));
        $show->field('license_expiry_date', __('License expiry date'));
        $show->field('date_of_registration', __('Date of registration'));
        $show->field('brief_profile', __('Brief profile'));
        $show->field('primary_phone_number', __('Primary phone number'));
        $show->field('secondary_phone_number', __('Secondary phone number'));
        $show->field('email', __('Email'));
        $show->field('postal_address', __('Postal address'));
        $show->field('services_offered', __('Services offered'));
        $show->field('ares_of_operation', __('Ares of operation'));
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
        $form->text('surname', __('Surname'))->rules('required');
        $form->text('given_name', __('Given name'))->rules('required');
        $form->text('nin', __('Nin'))->rules('required');
        $form->text('physical_address', __('Physical address'))->rules('required');
        $form->text('group_or_practice', __('Group or practice'))->rules('required');
        $form->text('license_number', __('License number'))->rules('required');
        $form->date('license_expiry_date', __('License expiry date'))->rules('required');
        $form->date('date_of_registration', __('Date of registration'))->rules('required');
        $form->textarea('brief_profile', __('Brief profile'));
        $form->text('primary_phone_number', __('Primary phone number'))->rules('required');
        $form->text('secondary_phone_number', __('Secondary phone number'));
        $form->email('email', __('Email'))->rules('required');
        $form->text('postal_address', __('Postal address'));
        $form->textarea('services_offered', __('Services offered'))->rules('required');
        $form->text('ares_of_operation', __('Ares of operation'))->rules('required');
        $form->file('certificate_of_registration', __('Certificate of registration'))->rules('required');
        $form->file('license', __('License'))->rules('required');
        $form->multipleFile('other_documents', __('Other documents'));

        return $form;
    }
}
