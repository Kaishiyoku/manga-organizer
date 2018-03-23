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
            $table->string('link_canonical', 191)->nullable();
            $table->string('title', 191)->nullable();
            $table->string('title_english', 191)->nullable();
            $table->string('title_japanese', 191)->nullable();
            $table->string('title_synonyms', 191)->nullable();
            $table->string('status', 191)->nullable();
            $table->string('image_url', 191)->nullable();
            $table->string('volumes', 191)->nullable();
            $table->string('chapters', 191)->nullable();
            $table->boolean('publishing')->default(false);
            $table->integer('rank')->nullable();
            $table->float('score')->nullable();
            $table->integer('scored_by')->nullable();
            $table->integer('popularity')->nullable();
            $table->integer('members')->nullable();
            $table->integer('favorites')->nullable();
            $table->text('synopsis')->nullable();
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
