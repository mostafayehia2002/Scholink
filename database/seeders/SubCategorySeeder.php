<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news=['exams','cleans'];
       foreach ($news as $n) {
           SubCategory::create([
               'category_id' => 1,
               'name' => $n,
           ]);
       }
        $announcement=['trip','concerts','dish party'];
        foreach ($announcement as $a) {
            SubCategory::create([
                'category_id' => 2,
                'name' => $a,
            ]);
        }
    }
}
