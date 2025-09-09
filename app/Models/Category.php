<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_th',
        'name_en',
        'parent_category_id',
        'icon',
        'description',
    ];
}
