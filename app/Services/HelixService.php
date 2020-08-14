<?php


namespace App\Services;

use App\HelixDb;
use App\Helpers\SqlProcess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelixService extends BaseService
{
    use sqlProcess;

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

    public function getdbTables()
    {

    }

    public function getTableColumns(string $dbName)
    {
        $columns = [];
        $dbTables = DB::select(DB::raw('SELECT table_name FROM information_schema.tables WHERE table_schema = :db'), ['db' => $dbName]);
        $tables = array_map(function ($item) {
            return $item->TABLE_NAME;
        }, $dbTables);

        foreach ($tables as $table) {
            $test = DB::select(DB::raw('SELECT COLUMN_NAME
                                            FROM INFORMATION_SCHEMA.COLUMNS
                                           WHERE TABLE_SCHEMA = :db AND TABLE_NAME = :table'), ['db' => $dbName, 'table' => $table]);

            $columns = array_merge($columns, array_map(function ($item) {
                return $item->COLUMN_NAME;
            }, $test));
        }

        return $columns;
    }

    public function searchFromSingleTable(Request $request)
    {
        if ($request->db !== 'privat_db') {
            $sql = "SELECT * FROM " . $request->db . " WHERE id IS NOT NULL ";
            $columns = json_decode($request->columns, true);

            foreach ($columns as $column) {
                foreach ($column as $columnName => $value) {
                    if (strpos($value, '*') !== false) {
                        $value = $this->processSqlString($value);
                        $sql .= "AND $columnName LIKE '$value'";
                    } else {
                        $sql .= "AND $columnName = '$value' ";
                    }
                }
            }
            return DB::connection($request->db)->select(DB::raw($sql));

        } else {
            $columns = json_decode($request->columns, true);
            $where = [];
            foreach ($columns as $column) {
                foreach ($column as $columnName => $value) {
                    if (strpos($value, '*') !== false) {
                        $value = $this->processSqlString($value);
                        $arr = [];
                        if($columnName === 'ipn'){
                            array_push($arr, 'passports.'.$columnName, 'LIKE', $value);
                        } elseif ($columnName === 'dob') {
                            array_push($arr, 'people.'.$columnName, 'LIKE', $value);
                        }
                        else {
                            array_push($arr, $columnName, 'LIKE', $value);
                        }
                        $where[] = $arr;
                    } else {
                        $arr = [];
                        if($columnName === 'ipn'){
                            array_push($arr, 'passports.'.$columnName, 'LIKE', $value);
                        } elseif ($columnName === 'dob') {
                            array_push($arr, 'people.'.$columnName, 'LIKE', $value);
                        } else {
                            array_push($arr, $columnName, 'LIKE', $value);
                        }
                        $where[] = $arr;
                    }
                }
            }

            $result = DB::connection($request->db)->table('people')
                ->select(
                    'people.surname',
                    'people.name',
                    'people.patronymic',
                    'people.dob',
                    'people.gender',
                    'people.login',
                    'people.translate',
                    'ankets.position',
                    'ankets.car',
                    'ankets.children',
                    'ankets.company',
                    'ankets.education',
                    'ankets.living',
                    'ankets.marital_status',
                    'address.address',
                    'ankets.occupation',
                    'ankets.occupation_position',
                    'passports.ipn',
                    'passports.date_document',
                    'passports.doc_series',
                    'phones.phone',
                    'auto.car_number',
                    'auto.car_model',
                    'auto.develop_year',
                    'auto.car_color',
                    'auto.car_weight',
                    'auto.car_body'
                )
                ->rightJoin('passports', 'passports.passport_id', '=', 'people.passport_id')
                ->rightJoin('ankets', 'ankets.anket_id', '=', 'people.anketa_id')
                ->rightJoin('address', 'address.address_id', '=', 'people.address_id')
                ->rightJoin('people_phone', 'people_phone.people_id', '=', 'people.people_id')
                ->rightJoin('phones', 'phones.id', '=', 'people_phone.phone_id')
                ->rightJoin('auto', 'auto.people_id', '=', 'people.people_id')
                ->where($where)
                ->get();

            return $result;
        }
    }

    public function searchByAllDb(Request $request)
    {
        $dbs = $this->getDbs();

        foreach ($dbs as $db) {

        }
    }
}
