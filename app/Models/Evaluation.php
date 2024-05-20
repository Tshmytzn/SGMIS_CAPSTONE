<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $table = 'evaluation';
    protected $primaryKey = 'eval_id';
    protected $fillable = [
        'eval_name',
        'event_id',
        'eval_description',
    ];
}
