<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $levels= Level::all();
       foreach ($levels as $level) {
           for ($i = 1; $i <= 3; $i++) {
               Classe::create(['level_id' => $level->id, 'class_name' => $i]);
           }
       }
    }
}
