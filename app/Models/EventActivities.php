<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventActivities extends Model
{
    use HasFactory;
    protected $table = 'event_activities';
    protected $primaryKey = 'eact_id';
    protected $fillable = [
       'event_id',
       'eact_name',
       'eact_description',
       'eact_facilitator',
       'eact_venue',
       'eact_date',
       'eact_time',
    ];
}
