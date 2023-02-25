o<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\LighthouseReport;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_have_many_companies()
    {
        $user = User::factory()->create();
        $company = Company::factory()->for($user)->create();
        $user->refresh();

        $this->assertCount(1, $user->companies);
        $this->assertTrue($user->companies->contains($company));
    }

    public function test_user_can_have_a_maximum_of_five_companies()
    {
        $user = User::factory()->create();
        Company::factory()->for($user)->count(5)->create();
        Company::factory()->for($user)->create();
        $user->refresh();

        $this->assertCount(5, $user->companies);
    }
}