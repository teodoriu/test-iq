<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $fillable = [
        'name',
        'auto_code',
        'region_id'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
