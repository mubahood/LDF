<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'farmer_id',
        'transaction_type',
        'transaction_date',
        'description',
        'amount',
        'payment_method',
        'party',
        'party_tin',
        'payment_reference',
        'reciept_file',
        'remarks',
        'recorded_by',
        
       
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
