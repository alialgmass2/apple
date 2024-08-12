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
        Schema::create('every_one_creates', function (Blueprint $table) {
            $table->id();
            $table->longText('text_en');
            $table->longText('text_ar');
            // $table->longText('text_2_en');
            // $table->longText('text_2_ar');
            $table->text('findout_link');
            $table->text('download_link');
// $table->decimal('image'); // default image m:m
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('every_one_creates');
    }
};
