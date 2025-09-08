<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'name_th',
        'name_en',
        'region',
        'latitude',
        'longitude',
    ];

    public function attractions()
    {
        return $this->hasMany(Attraction::class);
    }
}
