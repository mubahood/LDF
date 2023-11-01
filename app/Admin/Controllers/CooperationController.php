<?php

namespace App\Admin\Controllers;

use App\Models\Cooperation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CooperationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cooperation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cooperation());
        
        $grid->filter(function ($f) {
            $f->disableIdFilter();
            $f->like('name', 'Name');
            $f->like('production_type', 'Production type');
            $f->between('created_at', 'Filter by date')->date();
        });

        // $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->location()->name('Location');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
        $grid->column('production_type', __('Production type'));
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
        $show = new Show(Cooperation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('location_id', __('Location id'));
        $show->field('production_type', __('Production type'));
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
        $form = new Form(new Cooperation());

        $form->text('name', __('Name'));
        $form->select('location_id', __('Location'))->options(\App\Models\Location::pluck('name', 'id'));
        $form->text('production_type', __('Production type'));
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
