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
        Schema::create('catalog', function(Blueprint $table){
            $table->id();
            $table->foreignId('workout_id')->constrained();
            $table->string('name');
            $table->string('photo_path');
            $table->string('description');
            $table->string('difficulty');
            $table->string('video_link');
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
