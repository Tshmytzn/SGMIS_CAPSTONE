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
        Schema::create('budgeting_meal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_id')->nullable();
            $table->string('meal')->nullable();
            $table->integer(column: 'price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgeting_meal');
    }
};
