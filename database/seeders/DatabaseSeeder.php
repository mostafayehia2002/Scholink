<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Classe;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Admin::factory(10)->create();

        // \App\Models\Admin::factory()->create([
        //     'name' => 'Test Admin',
        //     'email' => 'test@example.com',
        // ]);

  $this->call([
      ClasseSeeder::class,
      ParentSeeder::class,
      StudentSeeder::class,
      CategorySeeder::class,
      SubCategorySeeder::class,
  ]);
    }
}
