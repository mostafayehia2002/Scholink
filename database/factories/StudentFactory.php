<?php

namespace Database\Factories;

use App\Models\Classe;
use App\Models\ParentStudent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'parent_id'=>ParentStudent::all()->unique()->random()->id,
                'name'=>['en'=>fake()->name(), 'ar'=>fake()->name()],
                'email'=>fake()->unique()->safeEmail(),
                'gender'=>fake()->randomElement(['male','female']),
                'class_id'=>Classe::all()->unique()->random()->id,
                'date_birth'=>fake()->date(),
                'password'=>Hash::make('123456'),
                'message_otp'=>null,
                'photo'=>'uploads/parents/profile/profile.jpg',
                'term'=>fake()->randomElement(['first','second']),
        ];
    }
}
