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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(1);
            $table->string('title_ua')->index();
            $table->string('title_en')->index();
            $table->text('description_ua');
            $table->text('description_en');
            $table->string('poster');
            $table->text('screenshots')->nullable();
            $table->string('trailer_id')->nullable()->index();
            $table->year('release_year')->index();
            $table->dateTime('view_start_date')->nullable()->index();
            $table->dateTime('view_end_date')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
