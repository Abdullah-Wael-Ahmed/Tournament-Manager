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
        Schema::create('team_participations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('event_id');

            $table->integer('score');

            $table->foreign('team_id')->references('id')->on('teams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('event_id')->references('id')->on('events')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_participations');
        
    }
};
