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
        Schema::create('school_event', function (Blueprint $table) {
            $table->id('event_id');
            $table->unsignedBigInteger('dept_id'); 
            $table->foreign('dept_id')->references('dept_id')->on('department');
            $table->string('event_name', 150);
            $table->string('event_desciption');
            $table->string('event_start', 20);
            $table->string('event_end', 20);
            $table->string('event_pic', 1500);
            $table->unsignedBigInteger('admin_id'); 
            $table->foreign('admin_id')->references('admin_id')->on('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_event');
    }
};
