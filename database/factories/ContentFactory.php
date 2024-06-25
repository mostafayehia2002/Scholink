<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category= Category::whereJsonContains('name->en','posts')->orWhereJsonContains('name->en','guidelines')->orWhereJsonContains('name->en','visions')->get();
        return array(
            'category_id'=>fake()->randomElement($category->pluck('id')),
            'admin_id'=>Admin::all()->unique()->random()->id,
            'content'=>fake()->paragraph(),
        );
    }
}
