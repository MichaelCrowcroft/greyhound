<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LighthouseReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_lighthouse_report_can_be_created(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $response = $this->actingAs($user)
            ->post('/companies/' . $company->id . '/lighthouse-report', [
                'url' => $lighthouse_report_url = 'https://www.example.com'
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('lighthouse_reports', ['url' => $lighthouse_report_url]);

    }

    public function test_companies_can_be_updated(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/companies/' . $company->id, [
                'name' => $company_name = 'Test Company',
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('companies', ['name' => $company_name]);
    }
}
