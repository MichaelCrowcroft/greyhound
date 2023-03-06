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
        $companies = auth()
            ->user()
            ->companies()
            ->with('lighthouseReports') //make this a closure where we do with where between date x and y.
            ->take(5)
            ->get();

        //make a collection for the date range selected in the where clause

        // split reports into their own collections
        $lighthouse_reports = $companies->pluck('lighthouseReports');

        // match by date (and add null when nothing available)


        return Inertia::render('Companies/Index', [
            'companies' => $companies,
            'lighthouse_reports' => $lighthouse_reports,
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
        $company = Company::with('lighthouseReports')->find($company->id);
        return Inertia::render('Companies/Show', [
            'company' => $company,
        ]);
    }
}
