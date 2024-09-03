<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionResult extends Model
{
    use HasFactory;
    protected $table = 'election_result';
    protected $primaryKey = 'result_id';

    protected $fillable = [
        'party_id',
        'candi_id',
        'result_status',
    ];
}
