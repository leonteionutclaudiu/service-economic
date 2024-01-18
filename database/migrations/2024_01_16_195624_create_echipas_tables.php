<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEchipasTables extends Migration
{
    public function up()
    {
        Schema::create('echipas', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
            
            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('echipa_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'echipa');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('echipa_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'echipa');
        });

        Schema::create('echipa_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'echipa');
        });
    }

    public function down()
    {
        Schema::dropIfExists('echipa_revisions');
        Schema::dropIfExists('echipa_translations');
        Schema::dropIfExists('echipa_slugs');
        Schema::dropIfExists('echipas');
    }
}
