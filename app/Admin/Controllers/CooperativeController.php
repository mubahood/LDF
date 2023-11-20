<?php

namespace App\Admin\Controllers;

use App\Models\Cooperative;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CooperativeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cooperative';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cooperative());
        
        $grid->filter(function ($f) {
            $f->disableIdFilter();
            $f->like('name', 'Name');
            $f->like('production_type', 'Production type');
            $f->between('created_at', 'Filter by date')->date();
        });

        // $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->location()->name('SubCounty');
        $grid->column('village', __('Village'));
        $grid->column('parish', __('Parish'));
        $grid->column('zone', __('Zone'));        $grid->column('production_type', __('Production type'));
        $grid->column('date_of_establishment', __('Date of establishment'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));                                                                                                                                      

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
        $show = new Show(Cooperative::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('location_id', __('SubCounty'));
        $show->field('village', __('Village'));
        $show->field('parish', __('Parish'));        $show->field('production_type', __('Production type'));
        $show->field('date_of_establishment', __('Date of establishment'));
        $show->field('certification', __('Certification'));
        $show->field('description', __('Description'));
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
        $form = new Form(new Cooperative());

        $form->text('name', __('Name'));
        $form->select('location_id', __('SubCounty'))->options(\App\Models\Location::where('parent','!=',0)->pluck('name', 'id'))->rules('required');
        $form->text('village', __('Village'))->rules('required');
        $form->text('parish', __('Parish'))->rules('required');
        $form->text('zone', __('Zone'))->rules('required');        $form->text('production_type', __('Production type'));
        $form->date('date_of_establishment', __('Date of establishment'));
        $form->file('certification', __('Certification'));
        $form->hidden('applicant_id');
        $form->textarea('description', __('Description'));


        $form->saving(function (Form $form) {
            $form->applicant_id = auth()->user()->id;
        });

        return $form;
    }
}
