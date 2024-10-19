<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BudgetMeal;
use Illuminate\Http\Request;
use App\Models\BudgetProposal;
use App\Models\SchoolEvents;
use App\Models\Committee;
use App\Models\CommitteeMember;
use App\Models\MealDate;

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
    
        $committeeMembers = CommitteeMember::whereIn('committee_id', $committees->pluck('id'))->get()->groupBy('committee_id');
    
        return view('Admin.budgetdetails', compact('budget', 'event', 'committees', 'committeeMembers'));
    }
    

    public function show2($id)
    {
        $budget = BudgetProposal::findOrFail($id);
        $event = SchoolEvents::where('event_id', $budget->eventid)->first();
        $committees = Committee::where('budgeting_id', $budget->id)->get();

        return view('Admin.budgetexpense', compact('budget', 'event', 'committees'));
    }

    public function budgetingProcess(request $request){
        if($request->process=='add'){
            $budget_id = $request->budget_id;

            $committees = $request->input('committee');

            foreach ($committees as $committee) {

                $committeeName = $committee['name'];
                $data = new Committee;
                $data->budgeting_id = $budget_id;
                $data->name = $committeeName;
                $data->save();

                if (isset($committee['members'])) {
                    foreach ($committee['members'] as $member) {
                        $memberName = $member['name'];
                        $memberRole = $member['role'];

                        $date2 =  new CommitteeMember;
                        $date2->committee_id = $data->id;
                        $date2->member_name = $memberName;
                        $date2->member_role = $memberRole;
                        $date2->save();
                    }
                }
            }

            return response()->json(['message' => 'SuccessFully Insert', 'reload' => 'loadMembers', 'status' => 'success']);
        }
        elseif($request->process=='get'){
            $budget_id = $request->budget_id;

            // Retrieve the committees for the given budget_id
            $committees = Committee::where('budgeting_id', $budget_id)->get();

            // Check if committees exist
            if ($committees->isEmpty()) {
                return response()->json([
                    'message' => 'No committees found for the provided budget_id',
                    'status' => 'error',
                ], 404);
            }

            // For each committee, attach the related members
            $committeesWithMembers = $committees->map(function ($committee) {
                $members = CommitteeMember::where('committee_id', $committee->id)->get();
                $committee->members = $members; // Add the members to the committee object
                return $committee;
            });

            // Return the committees with their members nested
            return response()->json([
                'message' => 'Successfully retrieved data',
                'data' => $committeesWithMembers,
                'status' => 'success',
            ]);
        }else if($request->process=='update'){

            if (!$request->has('committee')) {
                return response()->json(['message' => 'Committee data is required.'], 400);
            }

            $validatedData = $request->validate([
                'committee.*.id' => 'required|integer|exists:committees,id', // Ensure the committee ID exists
                'committee.*.name' => 'required|string|max:255', // Validate committee name
                'committee.*.members.*.name' => 'required|string|max:255', // Validate member name
                'committee.*.members.*.role' => 'required|string|in:Head,Member', // Validate member role
            ]);

            foreach ($validatedData['committee'] as $committeeData) {
                // Retrieve or create the committee
                $committee = Committee::updateOrCreate(
                    ['id' => $committeeData['id']], // Match by ID
                    ['name' => $committeeData['name']] // Update the name
                );

                // Optionally delete existing members if you want to reset members
                CommitteeMember::where('committee_id', $committeeData['id'])->delete();

                // Loop through each member in the committee
                foreach ($committeeData['members'] as $memberData) {
                    $member = new CommitteeMember; // Create new member
                    $member->committee_id = $committeeData['id'];
                    $member->member_name = $memberData['name'];
                    $member->member_role = $memberData['role'];
                    $member->save();
                }
            }

            return response()->json(['message' => 'Successfully Updated', 'reload' => 'loadEditCommittee2', 'status' => 'success']);

        }else if($request->process == 'delete'){

            $data = CommitteeMember::where('id',$request->data_id)->first();
            $data->delete();

            return response()->json(['message' => 'SuccessFully Deleted', 'reload' => 'loadEditCommittee2', 'status' => 'success']);
      
        } else if ($request->process == 'delete2') {

            $data = Committee::where('id', $request->data_id)->first();
            CommitteeMember::where('committee_id', operator: $data->id)->delete();
            $data->delete();

            return response()->json(['message' => 'SuccessFully Deleted', 'reload' => 'loadEditCommittee2', 'status' => 'success']);
        }
    }

    public function mealProcess(request $request){

        if($request->process == 'add'){
            $validatedData = $request->validate([
                'morning' => 'required|max:255',
                'lunch' => 'required|max:255',
                'afternoon' => 'required|max:255',
                'dinner' => 'required|max:255',
            ]);
            $b = BudgetMeal::where('budget_id', $request->budget_id)->get();
            if(count($b) > 0){
            foreach($b as $bb){
                $bb->delete();
            }
            }
            foreach ($validatedData as $key => $value) {
                $meal = new BudgetMeal();
                $meal->budget_id = $request->budget_id;
                $meal->meal = $key; // Use the key (morning, lunch, etc.) as the 'type'
                $meal->price = $value; // The corresponding value (meal name, etc.)
                $meal->save();
            }

            return response()->json(['message' => 'Meal Budget SuccessFully Set', 'reload' => 'loadBudgetDataTable', 'status' => 'success']);
        }
        else if($request->process == 'get'){

            $committees = Committee::where('budgeting_id', $request->budget_id)->get();
            $data = [];

            foreach ($committees as $com) {
                $meals = MealDate::where('committee_id', $com->id)->get();
                
                $data[] = [ 
                    'id' => $com->id,
                    'name' => $com->name,
                    'budget_id' => $com->budgeting_id,
                    'meals' => $meals, 
                ];
            }

            return response()->json(['message' => 'Successfully retrieved committees', 'data' => $data, 'status' => 'success']);

        }
    }

}
