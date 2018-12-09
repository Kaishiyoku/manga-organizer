<?php

namespace App\Console\Commands;

use App\Models\MalItem;
use Illuminate\Console\Command;
use Jikan\Exception\BadResponseException;
use Jikan\Exception\ParserException;
use Jikan\MyAnimeList\MalClient;
use Jikan\Request\Manga\MangaRequest;

class FetchMalItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mal:get_item {mal_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch MAL data for a single item';

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
        try {
            $malId = (int) $this->argument('mal_id');

            $this->line('  #' . $malId);

            fetchAndSaveMalItemFor($malId);
        } catch (ParserException | BadResponseException $e) {
            $this->error('Could not fetch data.');
            $this->error($e);
        }
    }
}
