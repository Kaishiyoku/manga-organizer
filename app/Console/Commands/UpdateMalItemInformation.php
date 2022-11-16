<?php

namespace App\Console\Commands;

use App\Models\MalItem;
use Illuminate\Console\Command;

class UpdateMalItemInformation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mal:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update MyAnimeList item information';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        MalItem::all()->each(function (MalItem $malItem) {
            fetchAndSaveMalItemFor($malItem->mal_id);

            $this->info("Updated {$malItem->title} ({$malItem->mal_id})");

            // sleep for 1.5 seconds to avoid rate limiting
            usleep(1.5 * 1000 * 1000);
        });

        return Command::SUCCESS;
    }
}
