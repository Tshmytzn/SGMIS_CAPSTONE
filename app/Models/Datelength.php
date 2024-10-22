<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datelength extends Model
{
    use HasFactory;
    protected $table = 'date_length';
    protected $primaryKey = 'id';
    protected $fillable = [
        'budget_id',
        'meal_date',
        'date_length',
    ];
}
