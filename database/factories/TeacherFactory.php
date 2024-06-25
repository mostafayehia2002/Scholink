<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'name'=>$this->faker->name(),
            'email'=>$this->faker->safeEmail(),
            'phone'=>$this->faker->numerify('010########'),
            'address'=>$this->faker->address(),
            'password'=>Hash::make('123456'),

        ];
    }
}
