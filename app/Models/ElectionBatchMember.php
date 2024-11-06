<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionBatchMember extends Model
{
    use HasFactory;

    protected $table = 'election_batch_member';
    protected $primaryKey = 'id';
    protected $fillable = [
        'election_id',
        'batch_date',
        'position',
        'name',
    ];
}
