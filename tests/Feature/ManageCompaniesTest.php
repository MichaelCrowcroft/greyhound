<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class ManageCompaniesTest extends TestCase
{
    use RefreshDatabase;

    public function test_companies_page_is_displayed_for_users(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/companies');

        $response->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Companies/Index')
            );
    }

    public function test_company_show_page_is_displayed_for_users(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()
            ->for($user)
            ->create();

        $response = $this->actingAs($user)
            ->get('/companies/' . $company->id);

        $response->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Companies/Show')
            );
    }

    public function test_companies_page_is_not_displayed_for_guests(): void
    {
        Company::factory()->count(3)->create();

        $response = $this->get('/companies');

        $response->assertRedirect();
    }

    public function test_company_show_page_is_not_displayed_for_guests(): void
    {
        $company = Company::factory()->create();

        $response = $this->get('/companies/' . $company->id);

        $response->assertRedirect();
    }

    public function test_companies_can_be_created(): void
    {
        $user = User::factory()->create();
        $company_data = [
            'name' => 'Xero',
            'url' => 'https://www.xero.com'
        ];

        $response = $this->actingAs($user)
            ->post('/companies', $company_data);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('companies', $company_data);
    }

    public function test_a_user_can_update_their_companies(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()
            ->for($user)
            ->create();

        $company_data = [
            'name' => 'Xero',
            'url' => 'https://www.xero.com'
        ];

        $response = $this
            ->actingAs($user)
            ->patch('/companies/' . $company->id, $company_data);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('companies', $company_data);
    }

    public function test_a_user_can_not_update_someone_elses_companies(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $company_data = [
            'name' => 'Xero',
            'url' => 'https://www.xero.com'
        ];

        $this->actingAs($user)
            ->patch('/companies/' . $company->id, $company_data);

        $this->assertDatabaseMissing('companies', $company_data);
    }

    public function test_a_guest_can_not_update_companies(): void
    {
        $company = Company::factory()->create();
        $company_data = [
            'name' => 'Xero',
            'url' => 'https://www.xero.com'
        ];

        $this->patch('/companies/' . $company->id, $company_data);

        $this->assertDatabaseMissing('companies', $company_data);
    }

    public function test_guests_can_not_create_companies(): void
    {
        $company_data = [
            'name' => 'Xero',
            'url' => 'https://www.xero.com'
        ];

        $this->post('/companies', $company_data);

        $this->assertDatabaseMissing('companies', $company_data);
    }
}
