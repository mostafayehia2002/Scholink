<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParentStudent>
 */
class ParentStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    $image=fake()->image('public/uploads/parents/register',640,480,'people',false);
       return [
            'name'=>['en'=>fake()->name(), 'ar'=>fake()->name()],
            'mobile'=> fake()->numerify('010########'),
            'email'=>fake()->unique()->safeEmail(),
            'national_id'=>fake()->numberBetween(0,1234567891234),
            'personal_identification'=>'uploads/parents/register/'.basename($image),
            'address'=>fake()->address(),
            'job'=>fake()->jobTitle(),
            'gender'=>fake()->randomElement(['male','female']),
            'date_birth'=>fake()->date(),
            'password'=>Hash::make('12345678'),
            'message_otp'=>'null',
            'photo'=>'uploads/parents/profile/profile.jpg'
        ];
    }
}
