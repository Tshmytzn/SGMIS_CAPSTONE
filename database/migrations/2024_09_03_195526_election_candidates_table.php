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
           Schema::create('election_candidates', function (Blueprint $table) {
            $table->id('candi_id');
            $table->integer('party_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->string('student_name')->nullable();
            $table->string('candi_picture')->nullable();
            $table->string('candi_position')->nullable();
            $table->string('group_of')->nullable();
            $table->string('candi_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('election_candidates');
    }
};
