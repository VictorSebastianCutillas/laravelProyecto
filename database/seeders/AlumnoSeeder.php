<?php

namespace Database\Seeders;

use App\Http\Controllers\AlumnoController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //https://laravel.com/docs/8.x/helpers#method-str-random
        //Password deberia pasar por una función comoHash::make('password')
        for($i = 0; $i < 10; $i++){
            DB::table('alumno')->insert([
                'nombre' => Str::random(32),
                'telefono' => Str::random(16),
                'edad' => rand(10, 99),
                'email' => Str::random(54).'@gmail.com',
                'password' => Str::random(64),
                'sexo' => Str::random(10)
            ]);
        }


    }
}
