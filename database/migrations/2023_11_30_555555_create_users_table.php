<?php

use App\Enums\UserType;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('user_type', UserType::values());
            $table->foreignId('region_id')->constrained('regions')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->foreignId('education_level_id')->nullable()->constrained()->cascadeOnDelete()->comment('if user type student else nullable');
            $table->foreignId('role_id')->nullable()->constrained()->cascadeOnDelete()->comment('if user type educator else nullable');
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('email')->unique();
            $table->string('password')->comment('fixed 123456');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('otp')->nullable()->comment('otp for login in each time');
            $table->boolean('otp_verified')->default(0)->comment('otp verified after login so redirect it to dashboard for example && use it to check when it in otp page after login');
            $table->string('forgot_password_otp')->nullable()->comment('used for reset password insted of seperated table');
            $table->boolean('is_forgot_password_otp_verfied')->default(0)->nullable()->comment('true 1 | WHICH MEAN VERIFIED OTP & GONES TO NEW PASSWORD PAGE');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
