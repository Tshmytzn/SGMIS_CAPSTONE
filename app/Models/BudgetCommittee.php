<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCommittee extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'committee_name',
        'person_in_charge',
    ];

    public function proposal()
    {
        return $this->belongsTo(BudgetProposal::class);
    }

    public function members()
    {
        return $this->hasMany(BudgetCommitteeMember::class);
    }
}