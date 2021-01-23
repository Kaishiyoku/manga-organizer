<?php

namespace App\Console\Commands;

use App\Models\MalItem;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

class FetchMalData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mal:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and update MyAnimeList data';

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
        $start = microtime(true);

        $malItems = MalItem::all();

        $this->line('[' . Carbon::now() . ']');
        $this->line('fetching data from MyAnimeList.net...');

        foreach ($malItems as $malItem) {
            $this->line('  #' . $malItem->mal_id);

            Artisan::call("mal:get_item", ['mal_id' => $malItem->mal_id]);

            // wait for 3 seconds so that we don't reach the API rate limiting
            sleep(3);
        }

        $timeElapsedInSeconds = microtime(true) - $start;

        $this->line('...finished. Duration: ' . number_format($timeElapsedInSeconds, 2) . ' seconds.');
        $this->line('');
    }
}
