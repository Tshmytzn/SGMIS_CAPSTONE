<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    protected $table = 'election';
    protected $primaryKey = 'elect_id';

    protected $fillable = [
        'elect_name',
        'elect_description',
        'elect_start',
        'elect_end',
        'elect_status',
    ];
}
