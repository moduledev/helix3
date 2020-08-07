<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voters extends Model
{
    protected $connection= 'voters_2019';
    protected $table = 'voters_2019';
    public $timestamps = false;
}
