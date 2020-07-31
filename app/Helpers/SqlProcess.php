<?php


namespace App\Helpers;


trait SqlProcess
{
    public function processSqlString($string)
    {
        return str_replace('*','_',$string);
    }
}
