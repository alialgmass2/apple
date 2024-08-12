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
        Schema::create('education_communities', function (Blueprint $table) {

            $table->id();
            $table->longText('text_en');
            $table->longText('text_ar');
            $table->text('title_en');
            $table->text('title_ar');
            $table->string('url');
// $table->longText('images');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_communities');
    }
};
