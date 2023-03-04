<?php

namespace App\Jobs;

use App\Models\LighthouseReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Lighthouse\Enums\Category;
use Spatie\Lighthouse\Lighthouse;

class RunLighthouseReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $company;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($company)
    {
        $this->onQueue('lighthouse');
        return $this->company = $company;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $report = Lighthouse::url($this->company->url)
            ->timeoutInSeconds(6000)
            ->run();
        $scores = $report->scores();

        LighthouseReport::create([
            'lighthouse_reportable_id' => $this->company->id,
            'lighthouse_reportable_type' => get_class($this->company),

            'performance' => $scores['performance'],
            'accessibility' => $scores['accessibility'],
            'best_practices' => $scores['best-practices'],
            'seo' => $scores['seo'],
            'pwa' => $scores['pwa'],
        ]);
        shell_exec("killall chrome");
    }

    public function failed(): void
    {
        shell_exec("killall chrome");
    }
}
