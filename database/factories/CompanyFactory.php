<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(),
            'name' => fake()->name(),
            'url' => fake()->url(),
            'is_primary' => false,
        ];
    }
}
