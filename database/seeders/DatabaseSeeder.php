<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\LighthouseReport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $xero = Company::factory()->for($user)->create(['url' => 'https://www.xero.com']);
        $quickbooks = Company::factory()->for($user)->create(['url' => 'https://www.quickbooks.com']);
        $myob = Company::factory()->for($user)->create(['url' => 'https://www.myob.com']);

        $count = 10;
        LighthouseReport::factory()
            ->for($xero, 'lighthouse_reportable')
            ->count($count)
            ->sequence(fn (Sequence $sequence) => [
                'created_at' => Carbon::now()->subDays($count)->addDays($sequence->index)
            ])
            ->create();

            LighthouseReport::factory()
            ->for($quickbooks, 'lighthouse_reportable')
            ->count($count - 3)
            ->sequence(fn (Sequence $sequence) => [
                'created_at' => Carbon::now()->subDays($count - 3)->addDays($sequence->index)
            ])
            ->create();

            LighthouseReport::factory()
            ->for($myob, 'lighthouse_reportable')
            ->count($count - 7)
            ->sequence(fn (Sequence $sequence) => [
                'created_at' => Carbon::now()->subDays($count - 7)->addDays($sequence->index)
            ])
            ->create();
    }
}
