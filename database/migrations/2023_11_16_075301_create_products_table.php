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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->text('title_en');
            $table->text('title_ar');
            $table->text('sub_title_en')->nullable();
            $table->text('sub_title_ar')->nullable();
            $table->longText('description_en');
            $table->longText('description_ar');
            $table->longText('features_ar');
            $table->longText('features_en');
            $table->string('video_ar');
            $table->string('video_en');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('discount')->default(0)->comment('will fill it later from discount sections');
// $table->decimal('image'); // default image m:m
// $table->decimal('images'); //multiable image m:m;
// $table->decimal('pdf'); //pdf file m:m;
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
