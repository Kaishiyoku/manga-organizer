<?php

namespace App\Console\Commands;

use App\Models\MalItem;
use Illuminate\Console\Command;
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
            $jikan = new MalClient();

            $malItem = MalItem::firstOrNew(['mal_id' => (int) $this->argument('mal_id')]);

            $this->line('  #' . $malItem->mal_id);

            $mangaItem = $jikan->getManga(new MangaRequest($malItem->mal_id));

            $malItem->url = $mangaItem->getUrl();
            $malItem->title = $mangaItem->getTitle();
            $malItem->title_english = $mangaItem->getTitleEnglish();
            $malItem->title_japanese = $mangaItem->getTitleJapanese();
            $malItem->title_synonyms = implode(';', $mangaItem->getTitleSynonyms());
            $malItem->status = $mangaItem->getStatus();
            $malItem->image_url = $mangaItem->getImageUrl();
            $malItem->volumes = $mangaItem->getVolumes();
            $malItem->chapters = $mangaItem->getChapters();
            $malItem->publishing = $mangaItem->isPublishing();
            $malItem->rank = $mangaItem->getRank();
            $malItem->score = $mangaItem->getScore();
            $malItem->scored_by = $mangaItem->getScoredBy();
            $malItem->popularity = $mangaItem->getPopularity();
            $malItem->members = $mangaItem->getMembers();
            $malItem->favorites = $mangaItem->getFavorites();
            $malItem->synopsis = $mangaItem->getSynopsis();

            $malItem->save();
        } catch (ParserException $e) {
            $this->error('Could not fetch data.');
            $this->error($e);
        }
    }
}
