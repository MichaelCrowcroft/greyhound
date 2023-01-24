<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_companies_page_is_displayed(): void
    {
        $user = User::factory()->create();
        Company::factory()->count(3)->create();

        $response = $this
            ->actingAs($user)
            ->get('/companies');

        $response->assertOk();
    }

    public function test_companies_can_be_created(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/companies', [
                'name' => $company_name = 'Test Company'
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('companies', ['name' => $company_name]);

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
