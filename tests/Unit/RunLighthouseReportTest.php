<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\LighthouseReport;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RunLighthouseReportTest extends TestCase
{
    use RefreshDatabase;

    // public function test_lighthouse_reports_can_be_scheduled()
    // {
        // Todo I think this needs a mock?
    //     Company::factory()->count(3)->create();
    //     $this->artisan('lighthouse-reports:schedule')->assertSuccessful();
    // }
}