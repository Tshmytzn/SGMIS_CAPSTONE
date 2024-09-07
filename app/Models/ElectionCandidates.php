<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionCandidates extends Model
{
    use HasFactory;
    protected $table = 'election_candidates';
    protected $primaryKey = 'candi_id';

    protected $fillable = [
        'party_id',
        'student_id',
        'student_name',
        'candi_picture',
        'candi_position',
        'candi_status',
    ];
}
