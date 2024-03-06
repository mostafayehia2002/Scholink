<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels=[
            [
                "level_number"=> 1,
               "level_name"=>['en'=>'First Level','ar'=>'الصف الاول'],
            ],[
                "level_number"=> 2,
                "level_name"=>['en'=>'Second Level','ar'=>'الصف الثاني'],
            ],[
                "level_number"=> 3,
                "level_name"=>['en'=>'Third Level','ar'=>'الصف الثالث'],
            ],[
            "level_number"=> 4,
            "level_name"=>['en'=>'Four Level','ar'=>'الصف الرابع'],
        ],[
                "level_number"=> 5,
                "level_name"=>['en'=>'Five Level','ar'=>'الصف الخامس'],
            ],[
                "level_number"=> 6,
                "level_name"=>['en'=>'Six Level','ar'=>'الصف السادس'],
            ],

        ];

        foreach ($levels as $level){

            Level::create($level);
        }

    }



}
