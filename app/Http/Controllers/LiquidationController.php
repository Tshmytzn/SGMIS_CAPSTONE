<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Liquidation;
use App\Models\SchoolEvents;
use App\Models\BudgetProposal;
use App\Models\BudgetMeal;
use App\Models\OtherExpenses;
use App\Models\Committee;
use App\Models\CommitteeMember;
use App\Models\MealDate;
use App\Models\DateLength;
use App\Models\LiquidationBreakdown;
use App\Models\LiquidationSummary;
use App\Models\FundAndDisbursement;

class LiquidationController extends Controller
{
    public function saveLiquidation(request $request){

        $data = new Liquidation;
        $data->liquidation_name = $request->liquidition_name;
        $data->event_id = $request->event;
        $data->semester = $request->semester;
        $data->date_from = $request->from;
        $data->date_to = $request->to;
        $data->save();

        return response()->json(['message' => 'Liquidation Successfully Added', 'status' => 'success']);
    }
    public function getAllLiquidationData(request $request){
        $data = Liquidation::join('school_event', 'liquidation.event_id', '=', 'school_event.event_id')
                   ->select('liquidation.*', 'school_event.event_name')
                   ->orderBy('liquidation.id', 'desc')
                   ->get();
        return response()->json(['data' => $data, 'status' => 'success']);
    }
    public function deleteLiquidation(request $request){
        $data = Liquidation::where('id',$request->id)->first();
        $data->delete();
        return response()->json(['message'=>'Liquidation Successfully Deleted', 'status' => 'success']);
    }

    public function liquidationDetailsData(request $request){

        $process = $request->process;

        switch ($process) {

            case 'get':
                $data = Liquidation::where('id',$request->id)->first();
                return response()->json(['data' => $data,'message' => 'The request is approved.']);

            case 'getB':
                $data=[];
                $firstevent = BudgetProposal::where('eventid', $request->id)->first();
                $dateLength = DateLength::where('budget_id',$firstevent->id)->get();
                $otherExpenses = OtherExpenses::where('budget_id',$firstevent->id)->get();
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

            case 'saveBudgeting':
                $datas = new LiquidationSummary;
                $datas->liquidation_id = $request->liquidation_id;
                $datas->name='Committee And Additional Expenses';
                $datas->total = $request->summary_total;
                $datas->save();

                $liquidation_id = $request->input('liquidation_id');
                $bdates = $request->input('bdate');
                $suppliers = $request->input('supplier');
                $items = $request->input('items');
                $invoices = $request->input('invoice');
                $totals = $request->input('total');
                foreach ($bdates as $key => $bdate) {
                    $data = new LiquidationBreakdown;
                    $data->liquidation_id = $liquidation_id;
                    $data->group_by=$datas->id;
                    $data->bdate = $bdate;
                    $data->supplier = $suppliers[$key] ?? null;
                    $data->item = isset($items[$key]) ? rtrim($items[$key], ', ') : null;
                    $data->invoice = $invoices[$key] ?? null;
                    $data->total = isset($totals[$key]) ? rtrim($totals[$key], ', ') : null;
                    $data->save();
                }
                return response()->json(['message' => 'Records saved successfully']);
            case 'getLiquidationEvent':
                $data = Liquidation::join('school_event', 'liquidation.event_id', '=', 'school_event.event_id')
                   ->select('liquidation.*', 'school_event.event_start', 'school_event.event_end')
                   ->where('liquidation.id', $request->id)
                   ->first();
                   return response()->json(['data' => $data,'message' => 'The request is approved.']);

            case 'getBudgetLiq':
                    $check = LiquidationSummary::where('liquidation_id',$request->Lid)->first();
                    $data =  LiquidationBreakdown::where('group_by', $check->id)->get();
                   return response()->json(['data'=>$data, 'message' => 'The request is approved.']);  
                   
            case 'insertOtherSummary':
                    // Validate the incoming request
                    $request->validate([
                        'date' => 'required|array',
                        'supplier' => 'required|array',
                        'items' => 'required|array',
                        'amount' => 'required|array',
                        'invoice_or_no' => 'required|array',
                        'liquidation_title' => 'required|string',
                        'liquidation_id' => 'required|string',
                        'total_expenses' => 'required|string',
                    ]);
                    $datas = new LiquidationSummary;
                    $datas->liquidation_id = $request->liquidation_id;
                    $datas->name=$request->liquidation_title;
                    $datas->total = $request->total_expenses;
                    $datas->save();

                    // Loop through the date array and create a new LiquidationBreakdown for each entry
                    foreach ($request->date as $index => $date) {
                        if (isset($request->supplier[$index])) {
                            $breakdown = new LiquidationBreakdown();
                            $breakdown->liquidation_id = $request->liquidation_id;
                            $breakdown->group_by = $datas->id;
                            $breakdown->bdate = $date;  // Assign the date
                            $breakdown->supplier = $request->supplier[$index];
                            $breakdown->item = $request->items[$index]; // Assign the supplier
                            $breakdown->invoice = $request->invoice_or_no[$index];
                            $breakdown->total = $request->amount[$index];
                            $breakdown->save();  // Save the instance to the database
                        }
                    }

                    return response()->json(['message' => 'Data inserted successfully!']);
            case 'getSaveTable':
                $data1 = LiquidationSummary::where('liquidation_id', $request->liquidation_id)->get();
                $data = [];
                foreach ($data1 as $dat) {
                    $data2 = LiquidationBreakdown::where('group_by', $dat->id)->get();
                    $data[] = [
                        'data1' => $dat,
                        'data2' => $data2,
                    ];
                }
                return response()->json(['data' => $data, 'message' => 'Data inserted successfully!']);
            
            case 'updateOtherSummary':

                // Validate the incoming request
                $request->validate([
                    'liquidation_title' => 'required|string',
                    'total_expenses' => 'required',
                    'group' => 'required|array',
                    'group.*.bdate' => 'required|date',
                    'group.*.supplier' => 'required|string',
                    'group.*.item' => 'required|array',
                    'group.*.invoice' => 'required|string',
                    'group.*.amount' => 'required|array',
                    'liquidation_id' => 'required|integer'  // Ensures liquidation_id is provided
                ]);

                // Find the existing LiquidationSummary record
                $datas = LiquidationSummary::find($request->dataID);
                if (!$datas) {
                    return response()->json(['error' => 'Liquidation Summary not found.'], 404);
                }

                // Update LiquidationSummary record
                $datas->name = $request->liquidation_title;
                $datas->total = is_array($request->total_expenses) ? $request->total_expenses[0] : $request->total_expenses;
                $datas->save();

                // Delete existing LiquidationBreakdown records associated with this group
                LiquidationBreakdown::where('group_by', $request->dataID)->delete();

                // Loop through each 'group' entry to create LiquidationBreakdown records
                foreach ($request->input('group') as $groupData) {
                    foreach ($groupData['item'] as $index => $item) {
                        $breakdown = new LiquidationBreakdown();
                        $breakdown->liquidation_id = $request->liquidation_id;
                        $breakdown->group_by = $datas->id;
                        $breakdown->bdate = $groupData['bdate'];
                        $breakdown->supplier = $groupData['supplier'];
                        $breakdown->item = $item;
                        $breakdown->invoice = $groupData['invoice'];
                        $breakdown->total = $groupData['amount'][$index];
                        $breakdown->save();
                    }
                }

                return response()->json(['message' => 'Data successfully updated!']);

            case 'deleteRow':
                $data = LiquidationBreakdown::find($request->dataID);
                $data->delete();
                if ($data) {
                    $data2 = LiquidationBreakdown::where('group_by', $data->group_by)->get();
                    
                    if ($data2->isNotEmpty()) {
                        // Calculate total using the sum method
                        $amount = $data2->sum('total');
                        $datas = LiquidationSummary::find($data->group_by);

                        if ($datas) {
                            $datas->total = $amount;
                            $datas->save();
                        }
                    }
                    
                }

                return response()->json(['data'=> $datas,'message' => 'Data successfully deleted!']);
            case 'deleteSummaryRecord':
                $data = LiquidationSummary::find($request->dataID);
                $data2 = LiquidationBreakdown::where('group_by',$data->id)->delete();
                $data->delete();
                return response()->json(['message' => 'Data successfully deleted!']);
            case 'getBudgetingData':
                $data = LiquidationSummary::where('name', 'Committee And Additional Expenses')->first();
                $budgetingData = LiquidationBreakdown::where('group_by', $data->id)->get();
                return response()->json(['data' => $budgetingData]);
            case 'updateBudgetingDataC':
                  foreach($request->budgetingID as $index =>$item){
                    $data = LiquidationBreakdown::where('id',$item)->first();
                    $data->supplier=$request->supplier[$index];
                    $data->invoice = $request->invoice[$index];
                    $data->save();
                  }
                return response()->json(['message' => 'Data successfully updated!']);
            case 'getAllLiquidationTotal':
                $total = LiquidationSummary::where('liquidation_id', $request->liquidation_id)->sum('total');
                return response()->json(['data' => $total]);
            case 'saveFund':
                $check = FundAndDisbursement::where('liquidation_id',$request->liquidation_id)->first();
                if($check){
                    $check->delete();
                }
                $data = new FundAndDisbursement();
                $data->liquidation_id = $request->liquidation_id;
                $data->coh = $request->coh;
                $data->cob = $request->cob;
                $data->tbb = $request->tbb;
                $data->te = $request->te;
                $data->eb = $request->eb;
                $data->coh2 = $request->coh2;
                $data->cob2 = $request->cob2;
                $data->save();
                return response()->json(['message' => 'STATEMENT OF SOURCE OF FUND AND DISBURSEMENT SUCCESSFULLY SAVED']);
            case 'getFund':
                $check = FundAndDisbursement::where('liquidation_id', $request->liquidation_id)->first();
                return response()->json(['data' => $check]);
        }

    }
}
