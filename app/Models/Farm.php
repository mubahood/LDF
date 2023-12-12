<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'coordinates',
        'location_id',
        'village',
        'parish',
        'zone',
        'livestock_type',
        'production_type',
        'date_of_establishment',
        'size',
        'profile_picture',
        'number_of_livestock',
        'number_of_workers',
        'land_ownership',
        'no_land_ownership_reason',
        'general_remarks',
        'owner_id',

    ];

    protected $guarded = [];

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }


    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function breeds()
    {
        return $this->belongsToMany(Breed::class);
    }

    public function productionRecords()
    {
        return $this->hasMany(ProductionRecord::class);
    }

    public function financialRecords()
    {
        return $this->hasMany(FinancialRecord::class);
    }

    public function animalHealthRecords()
    {
        return $this->hasMany(AnimalHealthRecord::class);
    }

    public function vectorAndDiseases()
    {
        return $this->hasMany(VectorAndDisease::class);
    }

    public function statuses()
    {
        return $this->morphMany(Status::class, 'statusable');
    }

    public function latestStatus()
    {
        return $this->morphOne(Status::class, 'statusable')->latestOfMany();
    }
}
