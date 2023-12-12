<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'owner_name',
        'owner_profile',
        'class_of_service',
        'date_of_registration',
        'physical_address',
        'primary_phone_number',
        'secondary_phone_number',
        'email',
        'postal_address',
        'other_services',
        'logo',
        'distroict_of_operation',
        'NDA_registration_number',
        'tin_number_business',
        'tin_number_owner',
        'license',
        'other_documents',
        'status',
        'user_id',


    ];

    public function statuses()
    {
        return $this->morphMany(Status::class, 'statusable');
    }

    public function latestStatus()
    {
        return $this->morphOne(Status::class, 'statusable')->latestOfMany();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
           
        });

          //call back to send a notification to the user
          self::created(function ($model) 
          {
              Notification::send_notification($model, 'ServiceProvider', request()->segment(count(request()->segments())));
          });

            //call back to send a notification to the user
            self::updated(function ($model) 
            {
                Notification::update_notification($model, 'ServiceProvider', request()->segment(count(request()->segments())-1));
                if($model->status == 'approved'){
                    AdminRoleUser::where([
                        'user_id' => $model->user_id
                    ])->delete();
                    $new_role = new AdminRoleUser();
                    $new_role->user_id = $model->user_id;
                    $new_role->role_id = 6;
                    $new_role->save();
                }
            
            });

    }
}
