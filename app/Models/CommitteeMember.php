<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    use HasFactory;

    protected $table = 'committee_members';

    protected $fillable =
    [
        'committee_id',
        'member_name',
        'member_role'
    ];

    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }
}

