<?php


namespace App\Services;

use App\HelixDb;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HelixService extends BaseService
{
    protected $model;

    public function __construct(HelixDb $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return array
     */
    public function isDbEnable()
    {
        $arr = [];
        foreach ($this->getDbs()->pluck('name')->toArray() as $db) {
            $dbStatus = DB::select(DB::raw("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :db"), ['db' => $db]);
            if (!empty($dbStatus) && $db === $dbStatus[0]->SCHEMA_NAME) {
               $arr[$db] = true;
            } elseif (empty($dbStatus)) {
                $arr[$db] = false;
            }
        }
        return $arr;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function getDbs()
    {
        return $this->all();
    }
}
