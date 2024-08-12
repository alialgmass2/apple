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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_level_id')->nullable()->constrained()->cascadeOnDelete()->comment('IF NULL | COURSES FOR ALL LEVELS | if id  = speclific educationLevel');
            $table->text('title_en');
            $table->text('title_ar');
            $table->string('estimated_time')->comment('course time by hours');
            $table->text('brief_en');
            $table->text('brief_ar');
            $table->longText('what_will_learn_en');
            $table->longText('what_will_learn_ar');
            $table->longText('content_en');
            $table->longText('content_ar');
            $table->longText('requirements_en');
            $table->longText('requirements_ar');
            $table->longText('description_en');
            $table->longText('description_ar');
            $table->longText('about_en');
            $table->longText('about_ar');
            // $table->longText('images'); : M:M
            // $table->longText('images_banner'); : M:M
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
