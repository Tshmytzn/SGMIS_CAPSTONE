<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\SchoolEvents;

class EvaluationController extends Controller
{
    public function CreateEvalForm(Request $req){
        $eval = new Evaluation;
        $eval->eval_name = $req->evalname;
        $eval->eval_description = $req->evaldesc;
        $eval->event_id = $req->event_id;
        $eval->save();

        return response()->json([
            'status'=>'success', 
            'eval_id'=>$eval->eval_id,
        ]);
    }

    public function GetEvalForm(Request $req){
        $eval = Evaluation::where('eval_id', $req->eval_id)->first();
        $event = SchoolEvents::where('event_id', $eval->event_id)->first();
        return response()->json(['eval'=> $eval, 'event'=> $event]);
    }

    public function GetAllEvalForm(){
      $eval = Evaluation::where('eval_status', 0)->get();
      return response()->json(['eval'=> $eval]);
    }
}
