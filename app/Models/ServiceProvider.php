<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

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
            });

    }
}
