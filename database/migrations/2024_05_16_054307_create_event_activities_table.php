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
        Schema::create('event_activities', function (Blueprint $table) {
            $table->id('eact_id');
            $table->unsignedBigInteger('event_id'); 
            $table->foreign('event_id')->references('event_id')->on('school_event');
            $table->string('eact_name');
            $table->string('eact_description');
            $table->string('eact_facilitator');
            $table->string('eact_venue');
            $table->string('eact_date');
            $table->string('eact_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_activities');
    }
};
