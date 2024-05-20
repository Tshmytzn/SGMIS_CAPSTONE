<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\SchoolEvents;
use App\Models\EvalQuestion;

class EvaluationController extends Controller
{
    public function CreateEvalForm(Request $req){
        $check = Evaluation::where('event_id', $req->event_id)->first();
        if($check){
            return response()->json([
                'status'=>'failed', 
                'eval_id'=>'none',
            ]);
        }else{
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

    public function DeleteEvalForm(Request $req){
        $question = EvalQuestion::where('eval_id', $req->eval_id)->get();
        foreach($question as $q){
            $q->delete();
        }
        $eval = Evaluation::where('eval_id', $req->eval_id)->first();
        $eval->delete();
        
        return response()->json(['status'=>'success']);
    }

    public function AddEvalQuestion(Request $req){
       $question = new EvalQuestion;
       $question->eval_id = $req->eval_id;
       $question->eq_question = $req->eval_question;
       $question->eq_scale = $req->eval_scale;
       $question->eq_num = $req->eval_num;
       $question->save();

       return response()->json(['status'=>'success']);
    }

    public function GetAllEvalQuestion(Request $req){
        $question = EvalQuestion::where('eval_id', $req->eval_id)->orderBy('eq_num', 'asc')->get();

        return response()->json(['question'=> $question]);
    }

    public function SwitchQuestionNum(Request $req){
        $getOldNum = $req->old_index + 1;
        $newIndex = $req->new_index + 1;
        $getNum = EvalQuestion::where('eval_id', $req->eval_id)->where('eq_num', $getOldNum)->first();
        $getNum->update([
            'eq_num'=>$newIndex,
        ]);
        if($newIndex - $getOldNum > 0){
            $updateOther = EvalQuestion::where('eval_id', $req->eval_id)->where('eq_num','<', $newIndex)->get();
            // foreach($updateOther as $other){
            //   $newNum = $other->eq_num - 1;
            //   $other->update([
            //     'eq_num'=> $newNum
            //   ]);
            // }
          }
  
       
       
      
        // if($newIndex - $getOldNum < 0){
        //     $updateOther = EvalQuestion::where('eval_id', $req->eval_id)->where('eq_num','<', $newIndex)->get();
        //     foreach($updateOther as $other){
        //       $newNum = $other->eq_num + 1;
        //       $other->update([
        //         'eq_num'=> $newNum
        //       ]);
        //     }
        // }

        return response()->json(['status'=> $updateOther ]);
       
    }
}
