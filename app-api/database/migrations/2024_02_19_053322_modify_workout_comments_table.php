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
        Schema::table('workout_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('workout_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workout_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('workout_id')->nullable()->change();
        });
    }
};
