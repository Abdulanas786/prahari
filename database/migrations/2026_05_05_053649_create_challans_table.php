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
        Schema::create('challans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prahari_id')->constrained('praharis')->onDelete('cascade');
            $table->foreignId('case_id')->constrained('cases')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->enum('status', ['Paid', 'Pending', 'Cancelled'])->default('Pending');
            $table->dateTime('Date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challans');
    }
};
