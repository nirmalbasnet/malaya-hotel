<?php

namespace App\Console\Commands;

use App\CrawlFunction\Crawl;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CrawlThirdParty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:thirdParty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl Data From Third Party';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Crawl::crawl();
    }
}
