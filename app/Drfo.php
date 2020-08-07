<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drfo extends Model
{
    protected $connection= 'drfo_2018';
    protected $table = 'drfo';
    public $timestamps = false;
}
