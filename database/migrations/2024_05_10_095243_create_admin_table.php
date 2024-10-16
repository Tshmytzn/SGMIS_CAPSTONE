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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('admin_name', 100)->nullable();
            $table->string('admin_school_id',50)->nullable();
            $table->string('admin_username', 100)->nullable();
            $table->string('admin_password', 60);
            $table->string('admin_type', 50)->nullable();
            $table->string('admin_pic', 100)->nullable();
            $table->timestamps();
        });

        DB::table('admin')->insert([
            [
                'admin_name' => 'Admin',
                'admin_school_id' => '000000001',
                'admin_username' => 'Admin',
                'admin_password' => Hash::make('Admin'),
                'admin_type' => 'Super Admin',
                'admin_pic' => 'default.png',
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
        Schema::dropIfExists('admin');
    }
};
