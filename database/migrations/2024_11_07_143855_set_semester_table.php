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
        Schema::create('set_semester', callback: function (Blueprint $table) {
            $table->id();
            $table->string('first_sem')->nullable();
            $table->string('first_start')->nullable();
            $table->string('first_end')->nullable();
            $table->string('second_sem')->nullable();
            $table->string('second_start')->nullable();
            $table->string('second_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_semester');
    }
};
