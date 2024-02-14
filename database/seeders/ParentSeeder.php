<?php

namespace Database\Seeders;

use App\Models\ParentStudent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParentStudent::create([
            'name'=>'ahmed',
            'mobile'=>'01226717838',
            'email'=>'ahmed@gmail.com',
            'national_id'=>'1245678129542',
            'address'=>'monufia',
            'job'=>'accountant',
            'gender'=>'male',
            'date_birth'=>'1980-05-02',
            'password'=>bcrypt('12345678'),
        ]);
    }
}
