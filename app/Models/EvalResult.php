<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalResult extends Model
{
    use HasFactory;
    protected $table = 'evaluation_result';
    protected $primaryKey = 'res_id';
    protected $fillable = [
      'student_id',
      'eq_id',
      'res_value'
    ];
}
