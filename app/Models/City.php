<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'county_id',
        'latitude',
        'longitude',
        'population_2002'
    ];

    public function county()
    {
        return $this->belongsTo(County::class);
    }
}
