<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'student_attendance';
    protected $primaryKey = 'at_id';
    protected $fillable = [
      'eact_id',
      'student_id',
      'start',
      'end',
      'time_in',
      'time_out',
      'status',
    ];
}
