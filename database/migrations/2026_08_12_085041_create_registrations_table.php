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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('origin_school');
            $table->string('phone');
            $table->string('parent_name')->nullable();
            $table->string('parent_email')->nullable();
            $table->string('parent_password')->nullable();
            $table->enum('status', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->enum('payment_status', ['Unpaid', 'Paid'])->default('Unpaid');
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
