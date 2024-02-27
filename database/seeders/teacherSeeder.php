<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class teacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'name'=>['en'=>'Teacher','ar'=>"معلم"],
            'email'=>'teacher@gmail.com',
            'phone'=>"01064564850",
            'address'=>'Mansoura',
            'password'=>bcrypt('123456')
        ]);
    }
}
