<?php


namespace App\Services;

use App\HelixDb;
use Illuminate\Database\Eloquent\Model;

class HelixService extends BaseService
{
    protected $model;

    public function __construct(HelixDb $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function getDbStatus()
    {
        $dbs = $this->getDbs()->pluck('slug');

    }

    public function getDbs()
    {
        return $this->all();
    }
}
