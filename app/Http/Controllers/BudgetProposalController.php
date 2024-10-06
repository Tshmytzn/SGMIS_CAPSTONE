<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BudgetProposal;
use App\Models\SchoolEvents;
use App\Models\Committee;


class BudgetProposalController extends Controller
{
    public function getBudgetProposal(Request $request)
    {

    if($request->process=='get')
    {

        $budget = BudgetProposal::all();
        return response()->json(['data' => $budget, 'status' => 'success']);

    }else if($request->process=='delete'){
        $budget = BudgetProposal::where('id', $request->budget_id)->first();
        $budget->delete();

        return response()->json(['message' => 'Budget Proposal Successfully Deleted','reload' => 'getBudgetingDetails', 'status' => 'success']);

    }
        try{

    $request->validate([
        'proposalTitle' => 'required|string|max:255',
        'budgetEvent' => 'required|exists:school_event,event_id',
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
    $data->eventid = $request->budgetEvent;
    $data->project_proponent = $request->projectproponent;
    $data->project_participant = $request->projectparticipant;
    $data->budget_period_start = $request->budgetPeriodStart;
    $data->budget_period_end = $request->budgetPeriodEnd;
    $data->funding_source = $request->fundingSource;
    $data->proposed_by = $request->proposedBy;
    $data->submission_date = $request->submissionDate;
    $data->additional_notes = $request->additionalNotes;
    $data->save();

    return response()->json(['message' => 'Budget Proposal Successfully Submitted','reload' => 'getBudgetingDetails','modal' => 'budgetProposalModal', 'status' => 'success']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Catch validation exceptions
            return response()->json(['message' => 'Validation Failed', 'errors' => $e->errors(), 'status' => 'error'], 422);
        } catch (\Exception $e) {
            // Catch any other exceptions
            return response()->json(['message' => 'An error occurred while submitting the budget proposal', 'error' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function show($id)
    {
        $budget = BudgetProposal::findOrFail($id);
        $event = SchoolEvents::where('event_id', $budget->eventid)->first();
        $committees = Committee::where('budgeting_id', $budget->id)->get();

        return view('Admin.budgetdetails', compact('budget', 'event', 'committees'));
    }



}
