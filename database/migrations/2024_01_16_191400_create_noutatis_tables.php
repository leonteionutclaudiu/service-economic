<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoutatisTables extends Migration
{
    public function up()
    {
        Schema::create('noutatis', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->text('subtitle')->nullable();

            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('noutati_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'noutati');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->text('subtitle')->nullable();
        });

        Schema::create('noutati_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'noutati');
        });

        Schema::create('noutati_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'noutati');
        });
    }

    public function down()
    {
        Schema::dropIfExists('noutati_revisions');
        Schema::dropIfExists('noutati_translations');
        Schema::dropIfExists('noutati_slugs');
        Schema::dropIfExists('noutatis');
    }
}
