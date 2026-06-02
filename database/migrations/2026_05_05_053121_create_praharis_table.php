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
        Schema::create('praharis', function (Blueprint $table) {
            $table->id();
            $table->string('Prahari');
            $table->string('Mobile');
            $table->string('AadhaarStatus')->default('Verified');
            $table->string('Bank_account_detail')->unique();
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('praharis');
    }
};
