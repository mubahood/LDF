<?php

namespace App\Admin\Controllers;

use App\Models\Vet;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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
        $grid->column('profile_picture', __('Profile picture'));
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
        $grid->column('certificate_of_registration', __('Certificate of registration'));
        $grid->column('license', __('License'));
        $grid->column('other_documents', __('Other documents'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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

        $form->text('profile_picture', __('Profile picture'));
        $form->text('title', __('Title'));
        $form->text('surname', __('Surname'));
        $form->text('given_name', __('Given name'));
        $form->text('nin', __('Nin'));
        $form->text('physical_address', __('Physical address'));
        $form->text('group_or_practice', __('Group or practice'));
        $form->text('license_number', __('License number'));
        $form->text('license_expiry_date', __('License expiry date'));
        $form->text('date_of_registration', __('Date of registration'));
        $form->textarea('brief_profile', __('Brief profile'));
        $form->text('primary_phone_number', __('Primary phone number'));
        $form->text('secondary_phone_number', __('Secondary phone number'));
        $form->email('email', __('Email'));
        $form->text('postal_address', __('Postal address'));
        $form->text('services_offered', __('Services offered'));
        $form->text('ares_of_operation', __('Ares of operation'));
        $form->text('certificate_of_registration', __('Certificate of registration'));
        $form->text('license', __('License'));
        $form->text('other_documents', __('Other documents'));

        return $form;
    }
}
