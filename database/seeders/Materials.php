<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Materials extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'lesson1',
                'descriptions' => 'description of lesson1',
                'type'=>'lesson',
                'url' => 'uploads/materials/pdf',
            ],
            [
                'title' => 'exam1',
                'descriptions' => 'description of exam1',
                'type'=>'exam',
                'url' => 'uploads/materials/pdf',
            ],
            [
                'title' => 'video',
                'descriptions' => 'description of video',
                'type'=>'video',
                'url' => 'uploads/materials/videos',
            ],
        ];

        foreach ($data as $d) {
            $material = Material::create([
                'class_id'=>1,
                'subject_id'=>1,
                'title' => $d['title'],
                'descriptions' => $d['descriptions'],
                'type'=>$d['type'],
            ]);

            $material->attachment()->create([
                'url' => $d['url'],
            ]);
        }
    }
}
