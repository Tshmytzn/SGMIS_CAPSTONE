<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealDate extends Model
{
    use HasFactory;
    protected $table = 'meal_date';
    protected $primaryKey = 'id';
    protected $fillable = [
        'committee_id',
        'meal_date',
    ];
}
