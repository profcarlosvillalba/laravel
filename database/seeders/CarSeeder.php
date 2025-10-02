<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Car::create([
            'patente'        => 'OOH757',
            'imagen'         =>  "",
            'modelo_id'      =>  1
        ]);

         Car::create([
            'patente'        => 'DTA239',
            'imagen'         =>  "",
            'modelo_id'      =>  2
        ]);

         Car::create([
            'patente'        => 'WXS457',
            'imagen'         =>  "",
            'modelo_id'      =>  2
        ]);

    }
}
