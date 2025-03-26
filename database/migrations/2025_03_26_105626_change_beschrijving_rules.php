<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('woningens', function (Blueprint $table) {
            $table->string('beschrijving', 15000)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('woningens', function (Blueprint $table) {
            $table->string('beschrijving')->change();
        });
    }
};
