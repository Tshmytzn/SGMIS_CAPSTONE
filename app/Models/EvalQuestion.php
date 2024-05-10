<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalQuestion extends Model
{
    use HasFactory;
    protected $table = 'eval_question';
    protected $primaryKey = 'eq_id';
    protected $fillable = [
         'eval_id',
         'question',
    ];
}
