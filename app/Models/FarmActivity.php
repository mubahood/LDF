<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'farm_id',
        'name',
        'scheduled_at',
        'description',
        'user_id',
    ];
        
  
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
