<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\LighthouseReport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LighthouseReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_lighthouse_report_belongs_to_a_company()
    {
        $lighthouse_report = LighthouseReport::factory()->create();

        $this->assertInstanceOf(Company::class, $lighthouse_report->company);
    }
}