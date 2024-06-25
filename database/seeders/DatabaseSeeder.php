<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Classe;
use App\Models\Comment;
use App\Models\Content;
use App\Models\News;
use App\Models\ParentStudent;
use App\Models\Reaction;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            PermissionTableSeeder::class,
            AdminSeeder::class,
            teacherSeeder::class,
            TermSeeder::class,
            LevelsSeeder::class,
            ClasseSeeder::class,
            ParentSeeder::class,
             StudentSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            SubjectSeeder::class,
            Materials::class
        ]);
//        //factories
       Admin::factory(5)->create()->each(function ($admin){
           $adminRole = Role::where('name', 'Admin')->first();
           if ($adminRole) {
               $admin->assignRole($adminRole);
           }
       });
        Teacher::factory(50)->create();
        ParentStudent::factory(100)->create();
        Student::factory(100)->create();
        Content::factory(100)->create()->each(function ($content){
            //if not guidlines
          if($content->category_id !=4 && fake()->boolean(50)){
                  $image = fake()->image('public/uploads/medias/', 680, 480);
                  $content->photo()->create(['name' => "uploads/medias/" . basename($image)]);
          }
        });
       Comment::factory(100)->create();
       Reaction::factory(100)->create();
         News::factory(100)->create()->each(function ($news){
             if(fake()->boolean(50)){
                 $image = fake()->image('public/uploads/medias/', 680, 480);
                 $news->photo()->create(['name' => "uploads/medias/".basename($image)]);
             }
         });
        Announcement::factory(100)->create();
    }

}
