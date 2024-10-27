<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidationSummary extends Model
{
    use HasFactory;
    protected $table = 'liquidation_summary';

    // Specify which columns are mass assignable
    protected $fillable = [
        'liquidation_id',
        'name',
        'total',
    ];
}
