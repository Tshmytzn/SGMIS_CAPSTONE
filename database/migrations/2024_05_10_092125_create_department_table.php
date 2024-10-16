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
        Schema::create('department', function (Blueprint $table) {
            $table->id('dept_id');
            $table->string('dept_name', 150)->nullable();
            $table->string('dept_image', 50)->nullable();
            $table->integer('dept_status')->default('0');
            $table->timestamps();
        });

        // Insert data into 'department' table
        DB::table('department')->insert([
            [
                'dept_name' => 'College of Arts and Sciences',
                'dept_image' => 'College-of-Arts-and-Sciences.png',
                'dept_status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'College of Computer Studies',
                'dept_image' => 'College-of-Computer-Studies.png',
                'dept_status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'College of Education',
                'dept_image' => 'College-of-Education.png',
                'dept_status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'College of Engineering',
                'dept_image' => 'College-of-Engineering.png',
                'dept_status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'College of Industrial Technology',
                'dept_image' => 'College-of-Industrial-Technology.png',
                'dept_status' => 0,
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
        Schema::dropIfExists('department');
    }
};
