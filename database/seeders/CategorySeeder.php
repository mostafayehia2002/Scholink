<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data=[
            ['name'=>['ar'=>'أخبار','en'=>'news']],
            ['name'=>['ar'=>'إعلانات','en'=>'announcements']],
            ['name'=>['ar'=>'مشاركات','en'=>'posts']],
            ['name'=>['ar'=>'الإرشادات','en'=>'guidelines']],
            ['name'=>['ar'=>'رؤى','en'=>'visions']],
        ];
        foreach ($data as $row) {
            Category::create($row);
        }
    }
}
