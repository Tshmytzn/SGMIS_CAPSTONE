<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherExpenses extends Model
{
    use HasFactory;
    protected $table = 'other_expenses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'quantity',
        'description',
        'price',
        'total',
    ];
}
