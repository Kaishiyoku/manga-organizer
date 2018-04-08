<?php

namespace App\Console\Commands;

use App\Models\MalItem;
use Illuminate\Console\Command;
use Jikan\Jikan;

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
        $jikan = new Jikan();
        $malItem = MalItem::firstOrNew(['mal_id' => (int) $this->argument('mal_id')]);

        $this->line('  #' . $malItem->mal_id);

        $data = $jikan->Manga($malItem->mal_id)->response;

        $malItem->link_canonical = $data['link_canonical'];
        $malItem->title = $data['title'];
        $malItem->title_english = $data['title_english'];
        $malItem->title_japanese = $data['title_japanese'];
        $malItem->title_synonyms = $data['title_synonyms'];
        $malItem->status = $data['status'];
        $malItem->image_url = $data['image_url'];
        $malItem->volumes = $data['volumes'];
        $malItem->chapters = $data['chapters'];
        $malItem->publishing = $data['publishing'];
        $malItem->rank = $data['rank'];
        $malItem->score = $data['score'];
        $malItem->scored_by = $data['scored_by'];
        $malItem->popularity = $data['popularity'];
        $malItem->members = $data['members'];
        $malItem->favorites = $data['favorites'];
        $malItem->synopsis = $data['synopsis'];

        $malItem->save();
    }
}
