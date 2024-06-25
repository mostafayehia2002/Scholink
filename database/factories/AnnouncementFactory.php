<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::with('subcategories')->whereJsonContains('name->en', 'announcements')->first();
        $image=fake()->image('public/uploads/medias',640,480,'people',false);
        return [
            'category_id' => $category->id,
            'subcategory_id' => fake()->randomElement($category->subcategories->pluck('id')),
            'price' => fake()->numerify(),
            'photo' => "uploads/medias/".basename($image),
            'admin_id' => Admin::all()->unique()->random()->id,
        ];
    }
}
