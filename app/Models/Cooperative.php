<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooperative extends Model
{
    use HasFactory;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
           
        });

          //call back to send a notification to the user
          self::created(function ($model) 
          {
              Notification::send_notification($model, 'Cooperative', request()->segment(count(request()->segments())));
          });

            //call back to send a notification to the user
            self::updated(function ($model) 
            {
                Notification::update_notification($model, 'Cooperative', request()->segment(count(request()->segments())-1));
            });

    }
}
