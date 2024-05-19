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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('school_id', 20);
            $table->unsignedBigInteger('sect_id'); 
            $table->foreign('sect_id')->references('sect_id')->on('section');
            $table->string('student_firstname', 100)->nullable();
            $table->string('student_middlename',100)->nullable();
            $table->string('student_lastname',100)->nullable();
            $table->string('student_ext',100)->nullable();
            $table->string('student_pass',60);
            $table->string('student_type',50)->nullable();
            $table->string('student_pic',150)->nullable();
            $table->string('student_position',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
