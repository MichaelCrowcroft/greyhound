<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\LighthouseReport;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_can_have_lighthouse_reports()
    {
        $company = Company::factory()->create();
        $lighthouse_report = LighthouseReport::factory()
            ->for($company, 'lighthouse_reportable')
            ->create();
        $company->refresh();

        dd($company->lighthouseReports);
        $this->assertCount(1, $company->lighthouseReports);
        $this->assertTrue($company->lighthouseReports->contains($lighthouse_report));
    }
}