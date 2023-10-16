<?php

namespace App\Admin\Controllers;

use App\Models\FinancialRecord;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;


class FinancialRecordController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FinancialRecord';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FinancialRecord());

        $grid->column('id', __('Id'));
        $grid->column('farm_id', __('Farm id'));
        $grid->column('farmer_id', __('Farmer id'));
        $grid->column('transaction_type', __('Transaction type'));
        $grid->column('transaction_date', __('Transaction date'));
        $grid->column('description', __('Description'));
        $grid->column('amount', __('Amount'));
        $grid->column('payment_method', __('Payment method'));
        $grid->column('party', __('Party'));
        $grid->column('party_tin', __('Party tin'));
        $grid->column('payment_reference', __('Payment reference'));
        $grid->column('reciept_file', __('Reciept file'));
        $grid->column('remarks', __('Remarks'));
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
        $show = new Show(FinancialRecord::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('farm_id', __('Farm id'));
        $show->field('farmer_id', __('Farmer id'));
        $show->field('transaction_type', __('Transaction type'));
        $show->field('transaction_date', __('Transaction date'));
        $show->field('description', __('Description'));
        $show->field('amount', __('Amount'));
        $show->field('payment_method', __('Payment method'));
        $show->field('party', __('Party'));
        $show->field('party_tin', __('Party tin'));
        $show->field('payment_reference', __('Payment reference'));
        $show->field('reciept_file', __('Reciept file'));
        $show->field('remarks', __('Remarks'));
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
        $form = new Form(new FinancialRecord());

        // $form->number('farm_id', __('Farm id'));
        $form->select('farm_id', __('Select Farm'))->options(\App\Models\Farm::pluck('name', 'id'));
        // $form->number('farmer_id', __('Farmer id'));
        $form->text('transaction_type', __('Transaction type'));
        $form->date('transaction_date', __('Transaction date'))->default(date('Y-m-d'));
        $form->textarea('description', __('Description'));
        $form->decimal('amount', __('Amount'));
        $form->text('payment_method', __('Payment method'));
        $form->text('party', __('Party'));
        $form->text('party_tin', __('Party tin'));
        $form->text('payment_reference', __('Payment reference'));
        $form->text('reciept_file', __('Reciept file'));
        $form->textarea('remarks', __('Remarks'));

        return $form;
    }
}
