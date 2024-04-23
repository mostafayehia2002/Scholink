<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $terms=[
            ['ar'=>'الاول','en'=>"First"],
            ['ar'=>'الثاني','en'=>"Second"],
        ];
        foreach ($terms as $term){
            Term::create(['name'=>$term]);
        }
    }
}
