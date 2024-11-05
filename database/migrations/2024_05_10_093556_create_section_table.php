<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

        // Now inserting the dummy data for sections
        $courses = DB::table('course')->get();  // Fetch all courses with course_id from 'course' table
        $year_levels = ['1', '2', '3', '4'];
        $sections = ['A', 'B', 'C'];  // Adjust based on the number of sections
        $sectionData = [];
        $now = now();

        foreach ($courses as $course) {
            $course_id = $course->course_id;  // Assuming course_id is the primary key of the course table

            foreach ($year_levels as $year_level) {
                foreach ($sections as $section) {
                    $sectionData[] = [
                        'course_id' => $course_id,
                        'sect_name' => $section,
                        'year_level' => $year_level,
                        'sect_status' => '0',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
        }

        // Insert the generated section data
        DB::table('section')->insert($sectionData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section');
    }
};
