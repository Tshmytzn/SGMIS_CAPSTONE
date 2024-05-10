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
        Schema::create('eval_question', function (Blueprint $table) {
            $table->id('eq_id');
            $table->unsignedBigInteger('eval_id'); 
            $table->foreign('eval_id')->references('eval_id')->on('evaluation');  
            $table->string('question');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_question');
    }
};
