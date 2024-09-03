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
         Schema::create('election', function (Blueprint $table) {
            $table->id('elect_id');
            $table->string('elect_name')->nullable();
            $table->string('elect_description')->nullable();
            $table->string('elect_start')->nullable();
            $table->string('elect_end')->nullable();
            $table->string('elect_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
