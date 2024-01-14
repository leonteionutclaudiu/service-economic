<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTables extends Migration
{
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
            
            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('home_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'home');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('home_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'home');
        });

        Schema::create('home_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'home');
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_revisions');
        Schema::dropIfExists('home_translations');
        Schema::dropIfExists('home_slugs');
        Schema::dropIfExists('homes');
    }
}
