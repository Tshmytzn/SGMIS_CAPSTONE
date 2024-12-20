<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('event_name', 150);
            $table->longText('event_description');
            $table->string('event_start', 20);
            $table->string('event_end', 20);
            $table->string('event_pic', 150);
            $table->string('event_facilitator', 150);
            $table->string('event_programme', 700)->nullable();
            $table->integer('event_status')->default(0);
            $table->string('admin_id'); 
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
