<?php

namespace App\Admin\Actions\Farmer;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;

class ApproveOrDeny extends RowAction
{
    public $name = 'Approve / Deny';



    public function form()
    {
        if(Admin::user()->isRole('ldf_admin')) {
            $this->select('is_verified', 'Approve Application')->options([
                1 => 'Approve',
                0 => 'Deny'
            ])->rules('required');
        } else if(Admin::user()->isRole('agent')) {
            $this->textarea('agent_remarks', 'Remarks')->rules('required');
            $this->hidden('is_verified')->default(0);
        }else {
            $this->select('is_verified', 'Approve Application')->options([
                1 => 'Approve',
                0 => 'Deny'
            ])->rules('required');
        }   


    }

    public function handle(Model $model, Request $request)
    {
        $is_verified = $request->get('is_verified');
        $agent_remarks = $request->get('agent_remarks');
        
        $model->is_verified = $is_verified;
        $model->agent_remarks = $agent_remarks;
        $model->save();

        return $this->response()->success('Action taken successfully')->refresh();
    }

}