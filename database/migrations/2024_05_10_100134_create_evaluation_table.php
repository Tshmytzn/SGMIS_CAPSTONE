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
        Schema::create('evaluation', function (Blueprint $table) {
            $table->id('eval_id');
            $table->string('eval_name', 200);
            $table->unsignedBigInteger('event_id'); 
            $table->foreign('event_id')->references('event_id')->on('school_event');
            $table->integer('eval_scale');
            $table->string('eval_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation');
    }
};
