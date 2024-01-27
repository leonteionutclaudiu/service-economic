<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programares', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('email');
            $table->string('telefon');
            $table->string('nr_inmatriculare');
            $table->text('mesaj')->nullable();
            $table->date('data_programare');
            $table->boolean('acceptata')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programares');
    }
};
