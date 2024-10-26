<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetProposal extends Model
{
    use HasFactory;
    protected $table = 'budget_proposals';

    // Specify which attributes should be mass assignable
    protected $fillable = [
        'title',
        'eventid',
        'project_proponent',
        'project_participant',
        'budget_period_start',
        'budget_period_end',
        'funding_source',
        'proposed_by',
        'submission_date',
        'additional_notes',
        'total_budget',
    ];

    protected $casts = [
        'budget_period_start' => 'date',
        'budget_period_end' => 'date',
        'submission_date' => 'date',
    ];
}