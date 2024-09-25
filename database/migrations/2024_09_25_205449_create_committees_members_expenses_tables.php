<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitteesMembersExpensesTables extends Migration
{
    public function up()
    {
        // Create Committees Table
        Schema::create('committees', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->integer('total_members')->default(0);
            $table->timestamps();
        });

        // Create Members Table
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->boolean('is_person_in_charge')->default(false);
            $table->timestamps();
        });

        // Create Expenses Table
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['Morning Snacks', 'Lunch', 'Afternoon Snacks', 'Dinner']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('members');
        Schema::dropIfExists('committees');
    }
}
