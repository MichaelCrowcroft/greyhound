<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\LighthouseReport;
use Illuminate\Console\Command;
use Spatie\Lighthouse\Lighthouse;

class RunLighthouseReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lighthouse-reports:run {company}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a lighthouse report and store the results';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $company = Company::find($this->argument('company'));
        $report = Lighthouse::url($company->url)
            ->timeoutInSeconds(600)
            ->run();
        $scores = $report->scores();

        LighthouseReport::create([
            'lighthouse_reportable_id' => $company->id,
            'lighthouse_reportable_type' => get_class($company),

            'performance' => $scores['performance'],
            'accessibility' => $scores['accessibility'],
            'best_practices' => $scores['best-practices'],
            'seo' => $scores['seo'],
            'pwa' => $scores['pwa'],
        ]);
    }
}
