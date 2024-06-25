<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{// $category=DB::table('categories')->where('name','news')->pluck('id')->first();
    // $sub_category=DB::table('sub_categories')->where('category_id',$category)->pluck('id');
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $category= Category::with('subcategories')->whereJsonContains('name->en', 'news')->first();
        return [
            'category_id' => $category->id,
            'subcategory_id' =>fake()->randomElement($category->subcategories->pluck('id')),
            'content' => fake()->paragraph(),
            'title'=>fake()->title(),
            'admin_id'=>Admin::all()->unique()->random()->id,
        ];
    }
}
