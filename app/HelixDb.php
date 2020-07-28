<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelixDb extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];
}
