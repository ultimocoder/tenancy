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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id')->nullable();
            $table->string('landlord_id')->nullable();
            $table->string('property_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->decimal('total_amount', 8,2)->nullable();
            $table->decimal('rental_amount', 8,2)->nullable();
            $table->string('discount')->nullable();
            $table->decimal('late_fee', 8,2)->nullable();
            $table->string('source_type')->nullable();
            $table->string('transfer_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('destination_id')->nullable();
            $table->string('destination_payment_id')->nullable();
            $table->date('transaction_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
