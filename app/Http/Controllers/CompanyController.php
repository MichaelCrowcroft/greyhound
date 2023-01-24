<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    public function index(): Response
    {
        $companies = Company::all();
        return Inertia::render('Companies/Index', ['companies' => $companies]);
    }

    public function create(): Response
    {
        return Inertia::render('Companies/Create');
    }

    public function store(Request $request): void
    {
        Company::create($request->validate([
            'name' => ['required', 'max:50'],
        ]));
    }

    public function update(Company $company, Request $request): void
    {
        $company->update($request->validate([
            'name' => ['required', 'max:50'],
        ]));
    }

    public function show(Company $company): Response
    {
        return Inertia::render('Companies/Show', ['company' => $company]);
    }
}
