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
        Schema::create('register_steps', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable();
            $table->string('user_type')->nullable();
            $table->foreignId('region_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('education_level_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('organization_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('password_without_hash')->comment('ONLY FOR AUTH CHECK WITH GUARD REGISTER_STEP FOR PAGE EX) REGISTER OTP ETC:');
            $table->string('otp')->nullable();
            $table->tinyInteger('step')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_steps');
    }
};
