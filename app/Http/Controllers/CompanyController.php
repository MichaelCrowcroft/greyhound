<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    public function index(): Response
    {
        $start = Carbon::now()->subDays(7)->startOfDay(); //Make dates adjustable as an input
        $end = Carbon::now()->subDays(1)->endOfDay();
        $period = CarbonPeriod::create($start, $end);
        $dates = collect($period->toArray())->mapWithKeys(function ($date) {
            return [$date->toDateTimeImmutable()->format('Y-m-d H:i:s') => [
                'performance' => null,
            ]];
        });

        $companies = auth()
            ->user()
            ->companies()
            ->with(['lighthouseReports' => function (Builder $query) use ($start, $end) {
                $query->whereDate('created_at', '>=', $start);
                $query->whereDate('created_at', '<=', $end);
            }])
            ->take(5)
            ->get();
        $lighthouse_reports = $companies->pluck('lighthouseReports', 'name');

        $lighthouse_reports = $lighthouse_reports->map(function ($item) use ($dates){
            $item = collect($item->keyBy('created_at')->toArray()); //Set the date as the key for records
            return $dates->merge($item); // Where there is a matching date with our prreset range returrn the corrosponding record, if not reutnr a null.
        })->toArray();


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
