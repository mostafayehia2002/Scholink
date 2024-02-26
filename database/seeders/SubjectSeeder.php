<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subjects=[
            ['en'=>'arabic','ar'=>'عربي'],
            ['en'=>'english','ar'=>'انجليزي'],
            ['en'=>'math','ar'=>'رياضيات'],
            ['en'=>'science','ar'=>'علوم']
        ];
        foreach ($subjects as $subject){
            Subject::create(['name'=>$subject]);
        }

    }
}
