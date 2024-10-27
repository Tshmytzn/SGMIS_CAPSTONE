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
        }

    }
}
