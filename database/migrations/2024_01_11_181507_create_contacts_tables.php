<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTables extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
            
            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('contact_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'contact');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('contact_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'contact');
        });

        Schema::create('contact_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'contact');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_revisions');
        Schema::dropIfExists('contact_translations');
        Schema::dropIfExists('contact_slugs');
        Schema::dropIfExists('contacts');
    }
}
