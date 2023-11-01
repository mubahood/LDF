<?php

namespace App\Admin\Controllers;

use App\Models\Farm;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;

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

        $grid->filter(function ($f) {
            $f->like('name', 'Name');
            $f->like('location', 'Location');
            $f->like('production_type', 'Production type');
            $f->between('created_at', 'Filter by date')->date();
        });

        if(Admin::user()->isRole('ldf_admin') || Admin::user()->isRole('administrator') || Admin::user()->isRole('agent')) {
            $grid->model()->latest();
        }else {
            $grid->model()->where('owner_id', Admin::user()->id)->latest();
        }

        $grid->column('profile_picture', __('Profile picture'))->image();
        $grid->column('name', __('Name'));
        $grid->column('location', __('Location'));
        $grid->column('production_type', __('Production type'));
        $grid->column('date_of_establishment', __('Date of establishment'));
        $grid->column('breeds', __('Breeds'))
        ->display(
            function ($x) {
                //breeds in badges
                if ($this->breeds()->count() > 0) {
                    $breeds = $this->breeds->map(function ($item) {
                        return  $item->name;
                    })->toArray();
                    return join(', ', $breeds);
                } else {
                    return '-';
                }
            }
        );
        $grid->column('size', __('Size (acres)'));
        $grid->column('number_of_workers', __('Number of workers'));
        $grid->column('land_ownership', __('Land ownership'));
        $grid->column('general_remarks', __('General remarks'));
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

        $form->image('profile_picture', __('Profile picture'));
        $form->text('name', __('Name'))->rules('required');
        $form->text('location', __('Location'))->rules('required'); //TODO: Add [lat, lng] and physical
        $form->multipleSelect('breeds', __('Select Breeds'))->options(\App\Models\Breed::pluck('name', 'id'));
        $form->text('production_type', __('Farm Type'))->rules('required')->help('e.g. Dairy, Beef, Eggs, etc.');
        $form->date('date_of_establishment', __('Date of establishment'))->default(date('Y-m-d'))->format('YYYY')->rules('required|before_or_equal:today');
        $form->text('size', __('Farm Size in acre'))->rules('required')->help('e.g. 10 acres, 20 acres, etc.');
        // $form->number('number_of_livestock', __('Number of livestock'));
        $form->number('number_of_workers', __('Number of workers'));
        $form->radio('land_ownership', __('Do you own the Farm land?'))->options(['Yes' => 'Yes', 'No' => 'No'])->default('Yes');
        $form->textarea('general_remarks', __('General remarks'));
        $form->hidden('owner_id');

        $form->saving(function (Form $form) {
            if($form->isCreating()) {
                $form->owner_id = auth()->user()->id;

            }
        });

        return $form;
    }
}
