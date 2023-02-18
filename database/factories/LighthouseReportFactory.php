<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LighthouseReportFactory extends Factory
{
    public function definition()
    {
        return [
            'lighthouse_reportable_id' => Company::factory(),
            'lighthouse_reportable_type' => Company::class,
            'performance' => fake()->numberBetween(0, 100),
            'accessibility' => fake()->numberBetween(0, 100),
            'best_practices' => fake()->numberBetween(0, 100),
            'seo' => fake()->numberBetween(0, 100),
            'pwa' => fake()->numberBetween(0, 100),
        ];
    }
}
