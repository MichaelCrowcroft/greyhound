<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\LighthouseReport;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        LighthouseReport::factory()->forCompany()->create(['url' => 'https://www.xero.com']);
        LighthouseReport::factory()->forCompany()->create(['url' => 'https://www.quickbooks.com']);
        LighthouseReport::factory()->forCompany()->create(['url' => 'https://www.myob.com']);
    }
}
