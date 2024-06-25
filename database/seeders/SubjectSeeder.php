<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects=[
            ['en'=>'arabic','ar'=>'عربي'],
            ['en'=>'english','ar'=>'انجليزي'],
            ['en'=>'math','ar'=>'رياضيات'],
            ['en'=>'science','ar'=>'علوم'],
            ['en'=>'Social Studies','ar'=>'دراسات اجتماعية'],
            ['en'=>'computer','ar'=>'حاسب ألي '],
            ['en'=>'actives','ar'=>'انشطة'],
        ];

        foreach ($subjects as $subject){

            Subject::create(['name'=>$subject]);
        }
    }
}
