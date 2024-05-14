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
        Schema::create('event_departments', function (Blueprint $table) {
            $table->id('ev_dept_id');
            $table->unsignedBigInteger('event_id'); 
            $table->foreign('event_id')->references('event_id')->on('school_event');
            $table->unsignedBigInteger('dept_id'); 
            $table->foreign('dept_id')->references('dept_id')->on('department');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_departments');
    }
};
