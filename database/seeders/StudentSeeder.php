<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'parent_id'=>1,
            'name'=>['en'=>'mostafa','ar'=>'مصطفي'],
            'email'=>'mostafa@gmail.com',
            'gender'=>'male',
            'class_id'=>1,
            'date_birth'=>'2016-04-06',
            'password'=>Hash::make('12345678'),
        ]);
    }
}
