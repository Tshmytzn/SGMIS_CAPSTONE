<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCommitteeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'member_name',
    ];

    public function committee()
    {
        return $this->belongsTo(BudgetCommittee::class);
    }
}