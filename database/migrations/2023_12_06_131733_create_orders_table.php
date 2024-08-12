<?php

use App\Enums\DeliverType;
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
        Schema::create('orders_old', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->comment('order owner || user');
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete()->comment('order owner | user  orgnization that he belongs');
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->enum('deliver_type', DeliverType::values());
            $table->text('address')->nullable()->comment('required_if deliver type set t0 DELIVER_TO_HOME');
            $table->string('phone')->nullable()->comment('required_if deliver type set t0 DELIVER_TO_HOME');
            $table->boolean('is_with_discount')->default(0)->comment('if bought with iscount price of organization');
            $table->decimal('price',10,2)->comment('ordered by this price may be same product price of after  iscount');
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->string('district');
            $table->string('short_national_id');
            $table->string('zip_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
