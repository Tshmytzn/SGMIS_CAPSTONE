<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // For data insertion

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id('course_id');
            $table->unsignedBigInteger('dept_id');
            $table->string('course_name');
            $table->string('course_status')->default('0');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('dept_id')->references('dept_id')->on('department')->onDelete('cascade');
        });

        // Insert data into 'course' table
        DB::table('course')->insert([
            [
                'dept_id' => 1, // Ensure this references a valid department
                'course_name' => 'Introduction to Programming',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1,
                'course_name' => 'Data Structures and Algorithms',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 2,
                'course_name' => 'Principles of Management',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 3,
                'course_name' => 'Circuit Analysis',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 4,
                'course_name' => 'Advanced Mathematics',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
