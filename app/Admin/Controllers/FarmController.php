<?php

namespace App\Admin\Controllers;

use App\Models\Farm;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FarmController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Farm';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Farm());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('location', __('Location'));
        $grid->column('livestock_type', __('Livestock type'));
        $grid->column('production_type', __('Production type'));
        $grid->column('date_of_establishment', __('Date of establishment'));
        $grid->column('size', __('Size'));
        $grid->column('profile_picture', __('Profile picture'));
        $grid->column('number_of_livestock', __('Number of livestock'));
        $grid->column('number_of_workers', __('Number of workers'));
        $grid->column('land_ownership', __('Land ownership'));
        $grid->column('general_remarks', __('General remarks'));
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
        $show = new Show(Farm::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('location', __('Location'));
        $show->field('livestock_type', __('Livestock type'));
        $show->field('production_type', __('Production type'));
        $show->field('date_of_establishment', __('Date of establishment'));
        $show->field('size', __('Size'));
        $show->field('profile_picture', __('Profile picture'));
        $show->field('number_of_livestock', __('Number of livestock'));
        $show->field('number_of_workers', __('Number of workers'));
        $show->field('land_ownership', __('Land ownership'));
        $show->field('general_remarks', __('General remarks'));
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
        $form = new Form(new Farm());

        $form->text('name', __('Name'));
        $form->text('location', __('Location'));
        $form->text('livestock_type', __('Livestock type'));
        $form->text('production_type', __('Production type'));
        $form->date('date_of_establishment', __('Date of establishment'))->default(date('Y-m-d'));
        $form->text('size', __('Size'));
        $form->text('profile_picture', __('Profile picture'));
        $form->number('number_of_livestock', __('Number of livestock'));
        $form->number('number_of_workers', __('Number of workers'));
        $form->text('land_ownership', __('Land ownership'));
        $form->textarea('general_remarks', __('General remarks'));

        return $form;
    }
}
