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
                'dept_id' => 1, 
                'course_name' => 'Bachelor of Arts in English Language',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1,
                'course_name' => 'Bachelor of Arts in Social Science',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1,
                'course_name' => 'Bachelor of Public Administration',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1,
                'course_name' => 'Bachelor of Science in Applied Mathematics',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1,
                'course_name' => 'Bachelor of Science in Psychology',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'dept_id' => 2,
                'course_name' => 'Bachelor of Science in Information Systems',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'dept_id' => 3,
                'course_name' => 'Bachelor of Early Childhood Education',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 3,
                'course_name' => 'Bachelor of Elementary Education',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 3,
                'course_name' => 'Bachelor of Physical Education',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 3,
                'course_name' => 'Bachelor of Special Needs Education',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 3,
                'course_name' => 'Bachelor of Technology and Livelihood Education major in Home Economics',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 3,
                'course_name' => 'Bachelor of Technical Vocational Teacher Education major in Electrical Technology',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'dept_id' => 4,
                'course_name' => 'Bachelor of Science in Civil Engineering',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'dept_id' => 5,
                'course_name' => 'Bachelor of Science in Industrial Technology major in Architectural Drafting Technology',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 5,
                'course_name' => 'Bachelor of Science in Industrial Technology major in Automotive Technology',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 5,
                'course_name' => 'Bachelor of Science in Industrial Technology major in Computer Technology',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 5,
                'course_name' => 'Bachelor of Science in Industrial Technology major in Electrical Technology',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 5,
                'course_name' => 'Bachelor of Science in Industrial Technology major in Electronics Technology',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 5,
                'course_name' => 'Bachelor of Science in Industrial Technology major in Fashion and Apparel Technology',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 5,
                'course_name' => 'Bachelor of Science in Industrial Technology major in Food Trades Technology',
                'course_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 5,
                'course_name' => 'Bachelor of Science in Industrial Technology major in Mechanical Technology',
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
