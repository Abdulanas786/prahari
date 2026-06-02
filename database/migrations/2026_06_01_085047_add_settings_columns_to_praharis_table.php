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
    Schema::table('praharis', function (Blueprint $table) {
        $table->string('language')->default('English');
        $table->boolean('notifications_enabled')->default(true);
    });
}

public function down(): void
{
    Schema::table('praharis', function (Blueprint $table) {
        $table->dropColumn([
            'language',
            'notifications_enabled'
        ]);
    });
}
};
