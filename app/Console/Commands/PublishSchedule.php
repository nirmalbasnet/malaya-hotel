<?php

namespace App\Console\Commands;

use App\BackendModel\Destination;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PublishSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:blog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Scheduled Blogs';

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
        $blogs = Destination::where('publish', 'no')->where('publish_schedule', '!=', null)->get();
        if($blogs->count() > 0)
        {
            foreach ($blogs as $blog)
            {
                $now = Carbon::now();
                $scheduled = Carbon::parse($blog->publish_schedule);
                if($now->gte($scheduled))
                {
                    Destination::find($blog->id)->update([
                        'publish' => 'yes'
                    ]);
                }
            }
        }
    }
}
