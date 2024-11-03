<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundAndDisbursement extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'fund_and_disbursement';

    protected $primaryKey = 'id';
    protected $fillable = [
        'liquidation_id',
        'coh',
        'cob',
        'tbb',
        'te',
        'eb',
        'coh2',
        'cob2',
    ];
}
