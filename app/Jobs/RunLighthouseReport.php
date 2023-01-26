<?php

namespace App\Jobs;

use App\Models\LighthouseReport;
use App\Models\LighthouseReportData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\Lighthouse\Lighthouse;

class RunLighthouseReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $lighthouse_report;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(LighthouseReport $lighthouse_report)
    {
        return $this->lighthouse_report = $lighthouse_report;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $report = Lighthouse::url($this->lighthouse_report->url)->run();
        $scores = $report->scores();
        $lighthouse_report_data = LighthouseReportData::create([
            'lighthouse_report_id' => $this->lighthouse_report->id,
            'performance' => $scores['performance'],
            'accessibility' => $scores['accessibility'],
            'best_practices' => $scores['best-practices'],
            'seo' => $scores['seo'],
            'pwa' => $scores['pwa'],
        ]);
        Log::info('Job run for ' . $lighthouse_report_data);
    }
}
