<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDepartment extends Model
{
    use HasFactory;
    protected $table = 'event_departments';
    protected $primaryKey = 'ev_dept_id';
    protected $fillable = [
      'event_id',
      'dept_id',
      'status',
    ];
}
