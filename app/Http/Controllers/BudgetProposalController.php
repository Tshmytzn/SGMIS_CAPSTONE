<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BudgetMeal;
use App\Models\OtherExpenses;
use Illuminate\Http\Request;
use App\Models\BudgetProposal;
use App\Models\SchoolEvents;
use App\Models\Committee;
use App\Models\CommitteeMember;
use App\Models\MealDate;
use App\Models\DateLength;
use Carbon\Carbon;

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

            $startDate = Carbon::createFromFormat('Y-m-d', $request->budgetPeriodStart);
            $endDate = Carbon::createFromFormat('Y-m-d', $request->budgetPeriodEnd);

            // Initialize an array to store the days

            // Loop through each day from the start date to the end date
            $currentDate = $startDate->copy();
            $dayCounter = 0;

            while ($currentDate->lte($endDate)) {
                
                $dayCounter++;

                $data2 = new DateLength();
                $data2->budget_id =$data->id;
                $data2->meal_date = $currentDate->toDateString();
                $data2->date_length = 'Day ' . $dayCounter;
                $data2->save();
                
                $currentDate->addDay();
            }


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
                'Morning' => 'required|max:255',
                'Lunch' => 'required|max:255',
                'Afternoon' => 'required|max:255',
                'Dinner' => 'required|max:255',
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
            $budget = BudgetProposal::where('id', $request->budget_id)->first();
            return response()->json(['message' => 'Meal Budget SuccessFully Set','budget_id'=> $request->budget_id, 'modal'=> 'exampleModal','reload' => 'loadBudgetDataTable', 'status' => 'success']);
        }
        else if($request->process == 'get'){

            $committees = Committee::where('budgeting_id', $request->budget_id)->get();
            $data = [];

            foreach ($committees as $com) {
                $meals = MealDate::where('committee_id', $com->id)->get();
                $totalPrice = 0; // Initialize totalPrice for each committee

                // Initialize an array to hold meal data
                $mealData = [];

                foreach ($meals as $mel) {
                    // Explode the meal string into an array
                    $mealsArray = explode(',', $mel->meal);

                    // Trim whitespace from each meal
                    $mealsArray = array_map('trim', $mealsArray);

                    // Loop through each meal and calculate the total price
                    foreach ($mealsArray as $meal) {
                        $budgetmeal = BudgetMeal::where('meal', $meal)->first();

                        // Check if budgetmeal exists before accessing the price
                        if ($budgetmeal) {
                            $totalPrice += $budgetmeal->price; // Add the price to totalPrice
                        }
                    }

                    // Store each meal's data (optional)
                    $mealData[] = [
                        'id' => $mel->id,
                        'meal_date' => $mel->meal_date,
                        'meal' => $mel->meal,
                        // Include additional fields if needed
                    ];
                }

                // Add committee data to the $data array
                $data[] = [
                    'id' => $com->id,
                    'name' => $com->name,
                    'budget_id' => $com->budgeting_id,
                    'meals' => $mealData, // Store the meal data array
                    'price' => $totalPrice, // Store the total price
                ];
            }

            return response()->json(['message' => 'Successfully retrieved committees', 'data' => $data, 'status' => 'success']);

        }
        else if ($request->process == 'get2') {

            $data=[];

            $dateLength = DateLength::where('budget_id',$request->budget_id)->get();
            $otherExpenses = OtherExpenses::where('budget_id',$request->budget_id)->get();
            foreach ($dateLength as $dl) {

                $mealDate= MealDate::where('meal_date',$dl->meal_date)->get();
                $totalPrice = 0;
                $committeeData=[];
                foreach ($mealDate as $md) {
                    $committees = Committee::where('id', $md->committee_id)->first();
                    $members = CommitteeMember::where('committee_id', $committees->id)->get();
                    $membersData = [];
                    foreach ($members as $mem) {
                    $membersData[] = $mem; 
                    }
                       
                    $mealsArray = explode(',', $md->meal);
                    $mealsArray = array_map('trim', $mealsArray);
                    $pricePerMeal=[];
                    foreach ($mealsArray as $meal) {
                        $budgetmeal = BudgetMeal::where('meal', $meal)->first();
                        if ($budgetmeal) {
                            $pricePerMeal[] = 
                            [
                               'meal'=> $meal,
                               'price'=> $budgetmeal->price,
                            ]; 
                        }
                    }
                    $committeeData[] = [
                        'committee_name' => $committees->name,
                        'committee_members' => $membersData,
                        'meal' => $pricePerMeal,
                    ];
                }
                $data[]=[
                    'meal_date'=>$dl->meal_date,
                    'date_length'=>$dl->date_length,
                    'meal_date_data'=> $committeeData,
                ];

            }

            return response()->json(['data' => $data,'data2'=>$otherExpenses, 'status' => 'success']);
        }
        else if($request->process == 'get_specific'){

            $committees = Committee::where('id', $request->committee_id)->first();
            $data = [];
                $meals = MealDate::where('committee_id', $committees->id)->get();

                $data[] = [
                    'id' => $committees->id,
                    'name' => $committees->name,
                    'budget_id' => $committees->budgeting_id,
                    'meals' => $meals,
                ];

            return response()->json(['message' => 'Successfully retrieved committees', 'data' => $data, 'status' => 'success']);

        }else if($request->process == 'remove_sched'){
            $meals = MealDate::where('id', $request->data_id)->first();
            $meals->delete();
            return response()->json(['message' => 'Meal Date Successfully Deleted','reload'=>'loadBudgetDataTable', 'status' => 'success']);
        }
        else if($request->process == 'sched'){
            $validatedData = $request->validate([
                'mealDate.*' => 'required',
            ]);
            if(empty($request->input('mealDate'))){
                return response()->json(['message' =>  'Date and Meal not set', 'status' => 'success']);
            }
            foreach ($request->input('mealDate') as $mealDateInput) {
                [$date, $meals] = explode(' / ', $mealDateInput);
                $checking=MealDate::where('committee_id',$request->committee_id)->where('meal_date',$date)->first();
                if ($checking) {
                    $errors[] = 'Date ' . $date . ' Already Added';
                    continue; // Skip saving if there's an error, but keep looping
                }
                $mealArray = explode(',', $meals);
                $mealString = implode(', ', $mealArray);
                $data= new MealDate();
                $data->committee_id = $request->committee_id;
                $data->meal_date=$date;
                $data->meal=$mealString;
                $data->save();
            }
            if (!empty($errors)) {
                $errorMessage = implode(', ', $errors);
                return response()->json(['message' => $errorMessage,'reload'=>'temp', 'status' => 'error']);
            }
            return response()->json(['message' =>  'Meal Date Successfully Submit','reload'=>'temp', 'status' => 'success']);
        }
    }

    public function otherExpensesProcess(request $request){
        if($request->process == 'add'){

            $quantities = $request->input('quantity');
            $descriptions = $request->input('description');
            $prices = $request->input('price');
            $totals = $request->input('total');

            // Loop through the inputs using the same index
            foreach ($quantities as $index => $quantity) {
                $description = $descriptions[$index];
                $price = $prices[$index];
                $total = $totals[$index];

                $data= new OtherExpenses();
                $data->budget_id=$request->budget_id;
                $data->description=$description;
                $data->quantity=$quantity;
                $data->price=$price;
                $data->total=$total;
                $data->save();
            }

            return response()->json(['message' =>  'Expenses Successfully Added', 'reload' => 'loadOtherExpensesTable', 'status' => 'success']);
        }else if($request->process == 'get'){
            $data = OtherExpenses::where('budget_id',$request->budget_id)->get();
            return response()->json(['data' => $data, 'status' => 'success']);
        }else if($request->process == 'update'){
            $data = OtherExpenses::where('id', $request->id)->first();
            $data->quantity=$request->quantity;
            $data->price = $request->price;
            $data->description = $request->description;
            $data->total = $request->total;
            $data->save();
            return response()->json(['message' =>  'Expenses Successfully Updated', 'reload'=> 'loadOtherExpensesTable','status' => 'success']);
        }else if($request->process=='delete')
        {
            $data = OtherExpenses::where('id', $request->data_id)->delete();
            return response()->json(['message' =>  'Expenses Successfully Deleted', 'reload' => 'loadOtherExpensesTable', 'status' => 'success']);
       
        }
        return response()->json(['message' =>  'Successfully Submit', 'status' => 'success']);
       
    }
    public function saveBudgetTotal(request $request){
        $data = BudgetProposal::where('id',$request->id)->first();
        $data->total_budget=$request->total;
        $data->save();
        return response()->json(['message' =>  'Successfully Submit', 'status' => 'success']);
    }
    public function updatebudgetinginfo(request $request) {

        $budget = BudgetProposal::where('id', $request->id)->first();
        $budget->title = $request->proposalTitle;
        $budget->eventid = $request->budgetEvent;
        $budget->project_proponent = $request->projectproponent;
        $budget->project_participant = $request->projectparticipant;
        $budget->budget_period_start = $request->budgetPeriodStart;
        $budget->budget_period_end = $request->budgetPeriodEnd;
        $budget->funding_source = $request->fundingSource;
        $budget->proposed_by = $request->proposedBy;
        $budget->submission_date = $request->submissionDate;
        $budget->additional_notes = $request->additionalNotes;
        $budget->save();

        $event = SchoolEvents::where('event_id', $budget->eventid)->first();
        return redirect()->route('viewbudget', ['id' => $budget->id]);
    }
}
