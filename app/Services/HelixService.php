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
        $sql = "SELECT * FROM " . $request->db . " WHERE id IS NOT NULL ";
        $columns = json_decode($request->columns, true);

        foreach ($columns as $column) {
            foreach ($column as $columnName => $value) {
                if (strpos($value, '*')) {
                    $value = $this->processSqlString($value);
                    $sql .= "AND $columnName LIKE '$value'";
                } else {
                    $sql .= "AND $columnName = '$value' ";
                }
            }
        }
        $result = DB::connection('mysql3')->select(DB::raw($sql));

        return $result;
    }
}
