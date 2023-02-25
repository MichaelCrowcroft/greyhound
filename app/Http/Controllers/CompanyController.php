<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\LighthouseReport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    public function index(): Response
    {
        $companies = auth()->user()->companies()->get()->take(5);
        return Inertia::render('Companies/Index', [
            'companies' => $companies,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Companies/Create');
    }

    public function store(Request $request): void
    {
        $data = $request->validate([
            'name' => ['required', 'max:50'],
            'url' => ['required', 'url']
        ]);

        auth()->user()->addCompany($data['name'], $data['url']);
    }

    public function update(Company $company, Request $request): void
    {
        $this->authorize('update', $company);

        $company->update($request->validate([
            'name' => ['required', 'max:50'],
            'url' => ['required', 'url']
        ]));
    }

    public function show(Company $company): Response
    {
        return Inertia::render('Companies/Show', [
            'company' => $company,
        ]);
    }
}
