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
        Schema::create('election_vote', function (Blueprint $table) {
            $table->id('vote_id');
            $table->integer('elect_id');
            $table->integer('party_id');
            $table->integer('candi_id');
            $table->integer('student_id');
            $table->string('vote_status')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('election_vote');
    }
};
