<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('genre_mal_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mal_item_id')->unsigned();
            $table->integer('genre_id')->unsigned();

            $table->foreign('mal_item_id')->references('mal_id')->on('mal_items');
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_mal_item');
        Schema::dropIfExists('genres');
    }
};
