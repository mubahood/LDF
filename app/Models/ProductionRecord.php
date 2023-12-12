<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionRecord extends Model
{
    use HasFactory;

    protected $fillable=[
        'breed_id',
        'farm_id',
        'production_type',
        'weight',
        'daily_weight_gain',
        'quantity',
        'quality',
        'input_ratios',
        'value_addition',
        'owner_id',


    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }
}
