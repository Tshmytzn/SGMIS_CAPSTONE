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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
