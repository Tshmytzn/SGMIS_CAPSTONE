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
        Schema::create('section', function (Blueprint $table) {
            $table->id('sect_id');
            $table->unsignedBigInteger('course_id'); 
            $table->foreign('course_id')->references('course_id')->on('course');
            $table->string('sect_name');
            $table->string('year_level');
            $table->string('sect_status')->default('0');
            $table->timestamps();
        });

        DB::table('section')->insert([
            // Sections for Course ID 1
            [
                'course_id' => 1, // Introduction to Programming
                'sect_name' => 'A',
                'year_level' => 'Second Year',
                'sect_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1, // Introduction to Programming
                'sect_name' => 'B',
                'year_level' => 'Second Year',
                'sect_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Sections for Course ID 2
            [
                'course_id' => 2, // Data Structures and Algorithms
                'sect_name' => 'A',
                'year_level' => 'Third Year',
                'sect_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2, // Data Structures and Algorithms
                'sect_name' => 'B',
                'year_level' => 'Third Year',
                'sect_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Sections for Course ID 3
            [
                'course_id' => 3, // Principles of Management
                'sect_name' => 'A',
                'year_level' => 'First Year',
                'sect_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 3, // Principles of Management
                'sect_name' => 'B',
                'year_level' => 'First Year',
                'sect_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Sections for Course ID 4
            [
                'course_id' => 4, // Circuit Analysis
                'sect_name' => 'A',
                'year_level' => 'Second Year',
                'sect_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 4, // Circuit Analysis
                'sect_name' => 'B',
                'year_level' => 'Second Year',
                'sect_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Additional Sections for Demonstration
            [
                'course_id' => 5, // Assuming there's a Course ID 5
                'sect_name' => 'A',
                'year_level' => 'First Year',
                'sect_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 5, // Assuming there's a Course ID 5
                'sect_name' => 'B',
                'year_level' => 'First Year',
                'sect_status' => '0',
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
        Schema::dropIfExists('section');
    }
};
