<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('school_event', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('event_name', 150);
            $table->string('event_description');
            $table->string('event_start', 20);
            $table->string('event_end', 20);
            $table->string('event_pic', 150);
            $table->string('event_facilitator', 150);
            $table->string('event_programme', 700)->nullable();
            $table->integer('event_status')->default(0);
            $table->unsignedBigInteger('admin_id'); 
            $table->foreign('admin_id')->references('admin_id')->on('admin');
            $table->timestamps();
        });

        // Inserting sample data for 3 events
        DB::table('school_event')->insert([
            // Upcoming Event
            [
                'event_name' => 'CHMSU Sportsfest 2024',
                'event_description' => 'A week-long sports event featuring different sports competitions among the students.',
                'event_start' => '2024-10-20',
                'event_end' => '2024-10-27',
                'event_pic' => 'sportsfest.jpg',
                'event_facilitator' => 'Coach Davis',
                'event_programme' => '1-HXDhatHzL9Ky5xr.jpg',
                'event_status' => 0,  
                'admin_id' => 1,  
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Finished Event
            [
                'event_name' => 'CHMSU Foundation Day 2024',
                'event_description' => 'A celebration marking the foundation of CHMSU with alumni gatherings and a grand parade.',
                'event_start' => '2024-09-01',
                'event_end' => '2024-09-05',
                'event_pic' => 'foundationday.jpg',
                'event_facilitator' => 'Mr. John Reyes',
                'event_programme' => '1-HXDhatHzL9Ky5xr.jpg',
                'event_status' => 2,  
                'admin_id' => 1,  
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
        Schema::dropIfExists('school_event');
    }
};
