<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetSemester extends Model
{
    use HasFactory;

    // The table associated with the model (optional if the table name is the plural of the model name)
    protected $table = 'set_semester';
    protected $primaryKey = 'id';
    // The attributes that are mass assignable
    protected $fillable = [
        'first_sem',
        'first_start',
        'first_end',
        'second_sem',
        'second_start',
        'second_end',
    ];

    // Optionally, if you don't want timestamps, you can disable them:
    // public $timestamps = false;
}
