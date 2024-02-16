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
        $data=['news','announcements','posts','guidelines','visions'];
        foreach ($data as $d) {
            Category::create(['name'=>$d]);
        }
    }
}
