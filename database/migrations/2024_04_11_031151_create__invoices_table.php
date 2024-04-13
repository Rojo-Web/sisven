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
        Schema::create('_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique();
            $table->integer('customer_id')->nullable();
            $table->date('date')->nullable();
            $table->integer('pay_mode_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_invoices');
    }
};
