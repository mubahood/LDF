<?php

namespace App\Admin\Controllers;

use App\Models\AnimalHealthRecord;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AnimalHealthController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'AnimalHealthRecord';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AnimalHealthRecord());

        $grid->column('id', __('Id'));
        $grid->column('record_type', __('Record type'));
        $grid->column('animal_id', __('Animal id'));
        $grid->column('diagnosis', __('Diagnosis'));
        $grid->column('treatment', __('Treatment'));
        $grid->column('user_id', __('User id'));
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
        $show = new Show(AnimalHealthRecord::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('record_type', __('Record type'));
        $show->field('animal_id', __('Animal id'));
        $show->field('diagnosis', __('Diagnosis'));
        $show->field('treatment', __('Treatment'));
        $show->field('user_id', __('User id'));
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
        $form = new Form(new AnimalHealthRecord());

        $form->text('record_type', __('Record type'));
        $form->select('animal_id', __('Select Animal'))->options(\App\Models\Animal::pluck('id', 'id'));
        $form->textarea('diagnosis', __('Diagnosis'));
        $form->textarea('treatment', __('Treatment'));
        $form->hidden('user_id')->value(auth()->user()->id);

        $form->saving(function (Form $form) {
            $form->user_id = auth()->user()->id;
        });

        return $form;
    }
}
