<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionVote extends Model
{
    use HasFactory;
    protected $table = 'election_vote';
    protected $primaryKey = 'vote_id';

    protected $fillable = [
        'elect_id',
        'party_id',
        'candi_id',
        'student_id',
        'vote_status',
    ];
}
