<?php

use App\HelixDb;
use Illuminate\Database\Seeder;

class HelixDbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dbs = [
            'privat_db' => 'База даних Приватбанк',
            'drfo_2018' => 'Державный реєстр фізачних осіб',
            'voters_2019' => 'Реєстр виборців 2019',
            'driver_licences' => 'База водійських посвідчень'
        ];

        foreach ($dbs as $name => $slug){
            HelixDb::create(['name'=> $name,'slug' => $slug]);
        }
    }
}
