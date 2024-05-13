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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique();
            $table->string('customer_id')->nullable();
            $table->foreign('customer_id')->references('document_number')->on('_customers')->nullOnDelete();
            $table->date('date')->nullable();
            $table->foreignId('pay_mode_id')->nullable()->references('id')->on('pay_mode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
