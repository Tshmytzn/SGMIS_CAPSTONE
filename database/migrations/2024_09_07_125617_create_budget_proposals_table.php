<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('budget_proposals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('eventid');
            $table->string('project_proponent');
            $table->string('project_participant');
            $table->date('budget_period_start');
            $table->date('budget_period_end');
            $table->string('funding_source');
            $table->string('proposed_by');
            $table->date('submission_date');
            $table->text('additional_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_proposals');
    }
};
