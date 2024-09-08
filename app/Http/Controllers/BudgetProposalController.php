<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BudgetProposal;
use App\Models\SchoolEvents;


class BudgetProposalController extends Controller
{
    public function getBudgetProposal(Request $request)
    {
    $request->validate([
        'proposalTitle' => 'required|string|max:255',
        // 'budgetEvent' => 'required|exists:school_events,event_id', // Ensure event exists
        'projectproponent' => 'required|string|max:255',
        'projectparticipant' => 'required|string|max:255',
        'budgetPeriodStart' => 'required|date',
        'budgetPeriodEnd' => 'required|date|after:budgetPeriodStart',
        'fundingSource' => 'required|string|max:255',
        'proposedBy' => 'required|string|max:255',
        'submissionDate' => 'required|date',
        'additionalNotes' => 'nullable|string',
    ]);

    $data = new BudgetProposal;
    $data->title = $request->proposalTitle;
    // $data->eventid = $request->budgetEvent;
    $data->project_proponent = $request->projectproponent;
    $data->project_participant = $request->projectparticipant;
    $data->budget_period_start = $request->budgetPeriodStart;
    $data->budget_period_end = $request->budgetPeriodEnd;
    $data->funding_source = $request->fundingSource;
    $data->proposed_by = $request->proposedBy;
    $data->submission_date = $request->submissionDate;
    $data->additional_notes = $request->additionalNotes;
    $data->save();

    return response()->json(['message' => 'Budget Proposal Successfully Submitted', 'status' => 'success']);
}

}
