<?php

namespace App\Admin\Controllers;

use App\Models\FarmActivity;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;

class FarmActivityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FarmActivity';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FarmActivity());

        $grid->column('id', __('Id'));
        $grid->column('farm_id', __('Farm id'));
        $grid->column('name', __('Name'));
        $grid->column('scheduled_at', __('Scheduled at'));
        $grid->column('description', __('Description'));
        $grid->column('user_id', __('User id'));
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
        $show = new Show(FarmActivity::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('farm_id', __('Farm id'));
        $show->field('name', __('Name'));
        $show->field('scheduled_at', __('Scheduled at'));
        $show->field('description', __('Description'));
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
        $form = new Form(new FarmActivity());

        $form->select('farm_id', __('Select Farm'))->options(\App\Models\Farm::pluck('name', 'id'));
        $form->text('name', __('Name'));
        $form->datetime('scheduled_at', __('Scheduled at'))->default(date('Y-m-d H:i:s'));
        $form->textarea('description', __('Description'));
        $form->hidden('user_id')->default(auth()->user()->id);

        $form->saving(function (Form $form) {
            $form->user_id = auth()->user()->id;
        });

        return $form;
    }
}
