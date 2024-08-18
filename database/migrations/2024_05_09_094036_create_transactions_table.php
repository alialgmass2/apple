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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->integer('amount')->nullable();
            $table->foreignId('order_id');
            $table->enum('type',['tabby','hyper_pay'])->default('hyper_pay');
            $table->enum('payment_method',['tabby','visa','master','mada'])->default('visa');
            $table->tinyInteger('status')->default(0);
            $table->tinyText('status_message');
            $table->string('last4Digits')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_phone')->nullable();
            $table->enum('payment_type',['debit','credit'])->default('debit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
