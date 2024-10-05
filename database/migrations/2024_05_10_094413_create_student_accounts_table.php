<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // For data insertion
use Illuminate\Support\Facades\Hash; // For password hashing

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

        DB::table('student_accounts')->insert([
            [
                'school_id' => '20201421',
                'sect_id' => 5, // Ensure this ID exists in 'section' table
                'student_firstname' => 'Jane',
                'student_middlename' => 'Ann',
                'student_lastname' => 'Doe',
                'student_ext' => 'Jr.',
                'student_pass' => Hash::make('20201421'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201422',
                'sect_id' => 6,
                'student_firstname' => 'Mark',
                'student_middlename' => 'Lee',
                'student_lastname' => 'Santos',
                'student_ext' => 'Sr.',
                'student_pass' => Hash::make('20201422'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201423',
                'sect_id' => 7,
                'student_firstname' => 'Emily',
                'student_middlename' => 'Grace',
                'student_lastname' => 'Lim',
                'student_ext' => 'III',
                'student_pass' => Hash::make('20201423'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201424',
                'sect_id' => 8,
                'student_firstname' => 'Carlos',
                'student_middlename' => 'Miguel',
                'student_lastname' => 'Reyes',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201424'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add additional students here
            [
                'school_id' => '20201425',
                'sect_id' => 5,
                'student_firstname' => 'John',
                'student_middlename' => 'Michael',
                'student_lastname' => 'Doe',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201425'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201426',
                'sect_id' => 6,
                'student_firstname' => 'Lisa',
                'student_middlename' => 'Marie',
                'student_lastname' => 'Smith',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201426'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201427',
                'sect_id' => 7,
                'student_firstname' => 'Derek',
                'student_middlename' => 'Alvin',
                'student_lastname' => 'Kim',
                'student_ext' => 'Jr.',
                'student_pass' => Hash::make('20201427'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201428',
                'sect_id' => 8,
                'student_firstname' => 'Sophia',
                'student_middlename' => 'Anne',
                'student_lastname' => 'Zhang',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201428'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201429',
                'sect_id' => 5,
                'student_firstname' => 'Michael',
                'student_middlename' => 'James',
                'student_lastname' => 'Johnson',
                'student_ext' => 'Sr.',
                'student_pass' => Hash::make('20201429'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201430',
                'sect_id' => 6,
                'student_firstname' => 'Olivia',
                'student_middlename' => 'Marie',
                'student_lastname' => 'Brown',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201430'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201431',
                'sect_id' => 7,
                'student_firstname' => 'Daniel',
                'student_middlename' => 'Carter',
                'student_lastname' => 'Garcia',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201431'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201432',
                'sect_id' => 8,
                'student_firstname' => 'Mia',
                'student_middlename' => 'Claire',
                'student_lastname' => 'Miller',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201432'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201433',
                'sect_id' => 5,
                'student_firstname' => 'Ethan',
                'student_middlename' => 'Alexander',
                'student_lastname' => 'Davis',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201433'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201434',
                'sect_id' => 6,
                'student_firstname' => 'Ava',
                'student_middlename' => 'Marie',
                'student_lastname' => 'Hernandez',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201434'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201435',
                'sect_id' => 7,
                'student_firstname' => 'Alexander',
                'student_middlename' => 'Daniel',
                'student_lastname' => 'Clark',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201435'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201436',
                'sect_id' => 8,
                'student_firstname' => 'Scarlett',
                'student_middlename' => 'Grace',
                'student_lastname' => 'Adams',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201436'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201437',
                'sect_id' => 5,
                'student_firstname' => 'Jacob',
                'student_middlename' => 'Ryan',
                'student_lastname' => 'Walker',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201437'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201438',
                'sect_id' => 6,
                'student_firstname' => 'Amelia',
                'student_middlename' => 'Sophia',
                'student_lastname' => 'Hall',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201438'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201439',
                'sect_id' => 7,
                'student_firstname' => 'James',
                'student_middlename' => 'Michael',
                'student_lastname' => 'Young',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201439'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school_id' => '20201440',
                'sect_id' => 8,
                'student_firstname' => 'Isabella',
                'student_middlename' => 'Ruth',
                'student_lastname' => 'King',
                'student_ext' => 'None',
                'student_pass' => Hash::make('20201440'), // Setting school_id as the password
                'student_type' => 'Student',
                'student_pic' => 'student.png',
                'student_position' => null, // Set to null
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
        Schema::dropIfExists('student_accounts');
    }
};
