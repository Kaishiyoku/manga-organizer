<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mal_items', function (Blueprint $table) {
            $table->renameColumn('link_canonical', 'url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mal_items', function (Blueprint $table) {
            $table->renameColumn('url', 'link_canonical');
        });
    }
};
