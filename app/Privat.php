<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privat extends Model
{
    protected $connection= 'privat_db';
    protected $table = 'people';
    public $timestamps = false;


}
