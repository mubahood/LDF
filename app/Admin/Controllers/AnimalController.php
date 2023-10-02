<?php

namespace App\Admin\Controllers;

use App\Models\Animal;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AnimalController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Animal';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Animal());

        $grid->column('id', __('Id'));
        $grid->column('farm_id', __('Farm id'));
        $grid->column('breed_id', __('Breed id'));
        $grid->column('parents', __('Parents'));
        $grid->column('dob', __('Dob'));
        $grid->column('date_of_weaning', __('Date of weaning'));
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
        $show = new Show(Animal::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('farm_id', __('Farm id'));
        $show->field('breed_id', __('Breed id'));
        $show->field('parents', __('Parents'));
        $show->field('dob', __('Dob'));
        $show->field('date_of_weaning', __('Date of weaning'));
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
        $form = new Form(new Animal());

        $form->number('farm_id', __('Farm id'));
        $form->number('breed_id', __('Breed id'));
        $form->text('parents', __('Parents'));
        $form->datetime('dob', __('Dob'))->default(date('Y-m-d H:i:s'));
        $form->date('date_of_weaning', __('Date of weaning'))->default(date('Y-m-d'));

        return $form;
    }
}
