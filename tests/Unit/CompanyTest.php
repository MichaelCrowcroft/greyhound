<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\LighthouseReport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_can_have_lighthouse_reports()
    {
        $company = Company::factory()
            ->has(LighthouseReport::factory()->count(3))
            ->create();

        $this->assertInstanceOf(LighthouseReport::class, $company->lighthouseReports->first());
    }

    public function test_company_can_add_lighthouse_report()
    {
        $company = Company::factory()->create();

        $lighthouse_report = $company->addLighthouseReport('https://www.example.com');

        $this->assertCount(1, $company->lighthouseReports);
        $this->assertTrue($company->lighthouseReports->contains($lighthouse_report));
    }
}