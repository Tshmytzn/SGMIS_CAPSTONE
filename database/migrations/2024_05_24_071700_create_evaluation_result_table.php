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
        Schema::create('evaluation_result', function (Blueprint $table) {
            $table->id('res_id');
            $table->unsignedBigInteger('student_id'); 
            $table->foreign('student_id')->references('student_id')->on('student_accounts');
            $table->unsignedBigInteger('eq_id'); 
            $table->foreign('eq_id')->references('eq_id')->on('eval_question');
            $table->string('res_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_result');
    }
};
