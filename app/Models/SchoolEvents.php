<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolEvents extends Model
{
    use HasFactory;

    protected $table = 'school_event';
    protected $primaryKey = 'event_id';
    protected $fillable = [
      'event_name',
      'event_description',
      'event_start',
      'event_end',
      'event_status',
      'event_facilitator',
      'event_programme',
      'event_pic',
      'admin_id',
    ];
}
