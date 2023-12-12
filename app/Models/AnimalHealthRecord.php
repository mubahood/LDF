<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalHealthRecord extends Model
{
    use HasFactory;

    protected $fillable=[
        'date',
        'record_type',
        'animal_id',
        'diagnosis',
        'treatment',
        'recorded_by',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    
}
