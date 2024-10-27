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
        Schema::create('liquidation_breakdown', callback: function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liquidation_id')->nullable();
            $table->string('group_by')->nullable();
            $table->string('bdate')->nullable();
            $table->string('supplier')->nullable();
            $table->string('item')->nullable();
            $table->string('invoice')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquidation_breakdown');
    }
};
