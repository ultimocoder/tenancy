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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('added_by_id')->nullable();
            $table->string('expense_type')->nullable();
            $table->string('property')->nullable();
            $table->string('desc')->nullable();
            $table->date('date')->nullable();
            $table->string('company_name')->nullable();
            $table->decimal('amount', 5,2)->nullable();
            $table->text('receipt')->nullable();
            $table->string('note')->nullable();
            $table->string('year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
