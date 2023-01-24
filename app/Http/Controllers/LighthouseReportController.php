<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\LighthouseReport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LighthouseReportController extends Controller
{
    public function store(Company $company, Request $request): void
    {
        $data = $request->validate([
            'url' => ['required', 'url'],
        ]);

        $company->addLighthouseReport($data['url']);
    }
}
