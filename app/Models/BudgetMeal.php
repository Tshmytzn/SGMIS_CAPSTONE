<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetMeal extends Model
{
    use HasFactory;
    protected $table = 'budgeting_meal';
    protected $primaryKey = 'id';
    protected $fillable = [
        'budget_id',
        'meal',
        'price',
    ];
}
