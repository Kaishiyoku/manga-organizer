<?php

use App\Models\Manga;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMalItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // remove existing mal_ids from the mangas table
        $mangas = Manga::whereNotNull('mal_id')->get();

        foreach ($mangas as $manga) {
            $manga->mal_id = null;
            $manga->save();
        }

        Schema::create('mal_items', function (Blueprint $table) {
            $table->integer('mal_id')->unsigned();
            $table->string('link_canonical', 191);
            $table->string('title', 191);
            $table->string('title_english', 191);
            $table->string('title_japanese', 191);
            $table->string('title_synonyms', 191);
            $table->string('status', 191);
            $table->string('image_url', 191);
            $table->string('volumes', 191);
            $table->string('chapters', 191);
            $table->boolean('publishing');
            $table->integer('rank');
            $table->float('score');
            $table->integer('scored_by');
            $table->integer('popularity');
            $table->integer('members');
            $table->integer('favorites');
            $table->text('synopsis');
            $table->timestamps();

            $table->primary('mal_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mal_items');
    }
}
