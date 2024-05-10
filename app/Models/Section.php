<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = 'section';
    protected $primaryKey = 'sect_id';
    protected $fillable = [
       'course_id',
       'sect_name',
       'year_level',
       'sect_status',
    ];
}
