<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidation extends Model
{
    use HasFactory;
    protected $table = 'liquidation';
    protected $primaryKey = 'id';
    protected $fillable = [
        'liquidation_name',
        'event_id',
        'semester',
        'date_from',
        'date_to',
    ];
}
