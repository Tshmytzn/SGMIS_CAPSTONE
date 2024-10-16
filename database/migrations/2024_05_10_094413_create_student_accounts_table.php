<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            $table->string('student_pass', 60);
            $table->string('student_type', 50)->nullable();
            $table->string('student_pic', 150)->nullable();
            $table->string('student_position', 50)->nullable();
            $table->timestamps();
        });

        // Arrays of realistic names
        $firstNames = ['John', 'Jane', 'Michael', 'Emily', 'Robert', 'Sarah', 'David', 'Jessica', 'James', 'Laura'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Martinez', 'Lee', 'Clark', 'Lewis'];
        $middleNames = ['Ann', 'Marie', 'Lynn', 'James', 'Edward', 'Grace', 'Elizabeth', 'Daniel', 'Rose', 'Lee'];
        
        // Now inserting dummy student data
        $sections = DB::table('section')->get();  // Fetch all sections with their sect_id
        $studentData = [];
        $now = now();

        foreach ($sections as $section) {
            $sect_id = $section->sect_id;

            // Adding 2 students per section
            for ($i = 1; $i <= 2; $i++) {
                $school_id = '2020' . str_pad($sect_id . $i, 4, '0', STR_PAD_LEFT); // Example school_id

                // Randomly assign first name, middle name, and last name
                $firstName = $firstNames[array_rand($firstNames)];
                $middleName = $middleNames[array_rand($middleNames)];
                $lastName = $lastNames[array_rand($lastNames)];

                $studentData[] = [
                    'school_id' => $school_id,
                    'sect_id' => $sect_id,
                    'student_firstname' => $firstName,
                    'student_middlename' => $middleName,
                    'student_lastname' => $lastName,
                    'student_ext' => null,
                    'student_pass' => Hash::make($school_id),  
                    'student_type' => 'Student',
                    'student_pic' => 'student.png',
                    'student_position' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        // Insert the generated student data
        DB::table('student_accounts')->insert($studentData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
