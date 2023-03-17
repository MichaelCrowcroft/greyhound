<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\LandingPage;
use App\Models\LighthouseReport;
use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;

class RunLandingPageSnapshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'landing-page-snapshot:run {landing-page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a landing page snapshot and store the results';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $landing_page = LandingPage::find($this->argument('landing-page'));
        $page = Browsershot::url($landing_page->url)->bodyHtml();

        $landing_page->addLandingPageSnapshot($page);
    }
}
