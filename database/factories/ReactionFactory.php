<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\ParentStudent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reaction>
 */
class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content_id'=>Content::all()->unique()->random()->id,
            'reactable_id'=>ParentStudent::all()->unique()->random()->id,
            'reactable_type'=>ParentStudent::class,
        ];
    }
}
