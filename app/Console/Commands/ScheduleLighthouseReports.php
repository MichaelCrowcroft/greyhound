<?php

namespace App\Console\Commands;

use App\Jobs\RunLighthouseReport;
use App\Models\LighthouseReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Spatie\Lighthouse\Lighthouse;

class ScheduleLighthouseReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lighthouse-reports:schedule';

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
        $lighthouse_reports = LighthouseReport::all();
        foreach($lighthouse_reports as $lighthouse_report) {
            RunLighthouseReport::dispatch($lighthouse_report);
        }
    }
}
