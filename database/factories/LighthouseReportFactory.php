<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LighthouseReportFactory extends Factory
{
    public function definition()
    {
        return [
            'company_id' => Company::factory(),
            'url' => fake()->url(),
        ];
    }
}
