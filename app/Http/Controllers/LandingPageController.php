<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LandingPageController extends Controller
{
    public function store(Company $company, Request $request): void
    {
        $data = $request->validate([
            'name' => ['required', 'max:50'],
            'url' => ['required', 'url']
        ]);

        $company->addLandingPage($data['name'], $data['url']);
    }

    public function show(Company $company, LandingPage $landing_page)
    {
        LandingPage::with('landingPageSnapshots')->find($landing_page->id);
        return Inertia::render('LandingPages/Show', [
            'landing_page' => $landing_page,
            'company' => $company
        ]);
    }
}
