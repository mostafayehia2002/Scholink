<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($x=1;$x<=6;$x++) {
            for ($i = 1; $i <= 3; $i++) {
                Classe::create(['level'=>$x,'class_name' => $i]);
            }
        }
    }
}
