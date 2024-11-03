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
        Schema::create('fund_and_disbursement', callback: function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liquidation_id')->nullable();
            $table->string('coh')->nullable();
            $table->string('cob')->nullable();
            $table->string('tbb')->nullable();
            $table->string('te')->nullable();
            $table->string('eb')->nullable();
            $table->string('coh2')->nullable();
            $table->string('cob2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_and_disbursement');
    }
};
