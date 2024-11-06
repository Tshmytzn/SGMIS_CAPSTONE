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
        Schema::create('election_batch_member', callback: function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('election_id')->nullable();
            $table->string('batch_date')->nullable();
            $table->string('position')->nullable();
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('election_batch_member');
    }
};
