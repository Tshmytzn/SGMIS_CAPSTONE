<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidationReceipt extends Model
{
    use HasFactory;
    protected $table = 'liquidation_receipt';

    // Specify which columns are mass assignable
    protected $fillable = [
        'liq_id',
        'liq_receipt',
    ];
}
