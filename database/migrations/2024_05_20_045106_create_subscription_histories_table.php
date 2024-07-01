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
        Schema::create('subscription_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('type')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('subscription_id')->nullable();
            $table->string('stripe_status')->nullable();
            $table->string('current_status')->nullable();
            $table->string('invoice_status')->nullable();
            $table->string('stripe_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('amount', 8,2)->nullable();
            $table->decimal('subtotal', 8,2)->nullable();
            
            $table->date('canceled_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_histories');
    }
};
