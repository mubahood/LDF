<?php

namespace App\Admin\Controllers;

use App\Models\ProductionRecord;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;


class ProductionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProductionRecord';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductionRecord());

        $grid->column('id', __('Id'));
        $grid->column('breed_id', __('Breed id'));
        $grid->column('farm_id', __('Farm id'));
        $grid->column('production_type', __('Production type'));
        $grid->column('weight', __('Weight'));
        $grid->column('daily_weight_gain', __('Daily weight gain'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('quality', __('Quality'));
        $grid->column('input_ratios', __('Input ratios'));
        $grid->column('value_addition', __('Value addition'));
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
        $show = new Show(ProductionRecord::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('breed_id', __('Breed id'));
        $show->field('farm_id', __('Farm id'));
        $show->field('production_type', __('Production type'));
        $show->field('weight', __('Weight'));
        $show->field('daily_weight_gain', __('Daily weight gain'));
        $show->field('quantity', __('Quantity'));
        $show->field('quality', __('Quality'));
        $show->field('input_ratios', __('Input ratios'));
        $show->field('value_addition', __('Value addition'));
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
        $form = new Form(new ProductionRecord());

        $form->select('farm_id', __('Select Farm'))->options(\App\Models\Farm::pluck('name', 'id'));
        $form->select('breed_id', __('Select Breed'))->options(\App\Models\Breed::pluck('name', 'id'));
        $form->text('production_type', __('Production type'));
        $form->text('weight', __('Weight'));
        $form->text('daily_weight_gain', __('Daily weight gain'));
        $form->text('quantity', __('Quantity'));
        $form->text('quality', __('Quality'));
        $form->number('input_ratios', __('Input ratios'));
        $form->text('value_addition', __('Value addition'));

        return $form;
    }
}
