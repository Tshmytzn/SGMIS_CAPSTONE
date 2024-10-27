<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidationBreakdown extends Model
{
    use HasFactory;
    protected $table = 'liquidation_breakdown';

    // Specify which columns are mass assignable
    protected $fillable = [
        'liquidation_id',
        'group_by',
        'bdate',
        'supplier',
        'item',
        'invoice',
        'total',
    ];
}
