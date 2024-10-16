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
        Schema::create('election_party', function (Blueprint $table) {
            $table->id('party_id');
            $table->integer('elect_id')->nullable();
            $table->string('party_name')->nullable();
            $table->string('party_description')->nullable();
            $table->string('party_picture')->nullable();            
            $table->string('party_status')->nullable();
            $table->timestamps();
        });    
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('election_party');
    }
};
