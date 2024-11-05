<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\SchoolEvents;
use App\Models\EvalQuestion;
use App\Models\EvalResult;

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

       return response()->json(['status'=>'success', 'id'=> $question->eq_id]);
    }

    public function GetAllEvalQuestion(Request $req){
        $question = EvalQuestion::where('eval_id', $req->eval_id)->orderBy('eq_num', 'asc')->get();

        return response()->json(['question'=> $question]);
    }

    public function SwitchQuestionNum(Request $req){
       $allData = explode(',', $req->allupdate);
       array_pop($allData);
       foreach($allData as $data){
        $id = explode('-', $data)[0];

        if($id !== '' || $id !== null){
            $question = EvalQuestion::where('eq_id', $id)->first();
            $question->update(['eq_num'=> explode('-', $data)[1]]);
        }
       }

       return response()->json(['status'=> 'success']);

    }

    public function DeleteEvalQuestion(Request $req){
     if($req->eq_id != '' || $req->eq_id != null){
        $eval = EvalQuestion::where('eq_id', $req->eq_id)->first();
        $finalCount = EvalQuestion::where('eval_id', $req->eval_id)->get()->count() - 1;
        $num = $eval->eq_num;
        $eval->delete();
        return response()->json(['status'=>'success', 'id'=> $req->eq_id, 'num'=> $num, 'q_count'=>$finalCount]);
     }else{
        return response()->json(['status'=>'success', 'id'=> 'none', 'num'=> 'none', 'q_count'=>'none']);
     }
    }

    public function UpdateEvalQuestion(Request $req){
        $eval = EvalQuestion::where('eq_id', $req->q_id)->first();
        $eval->update([
           'eq_question'=>$req->q_name,
           'eq_scale'=> $req->q_scale,
        ]);

        return response()->json(['status'=>'success', 'question'=> $req->q_name, 'scale'=> $req->q_scale]);
    }

    public function GetEvalQuestion(Request $req){
        $eval = EvalQuestion::where('eq_id', $req->q_id)->first();

        return response()->json(['question'=> $eval]);
    }

    public function LoadQuestionEvaluate(Request $req){
       $question = EvalQuestion::where('eval_id', $req->eval_id)->orderBy('eq_num', 'asc')->get();

       $evaluateStatus = false;
       foreach($question as $q){
        $result = EvalResult::where('eq_id', $q->eq_id)->where('student_id', session('student_id'))->first();
        if($result){
            $evaluateStatus = true;
        }
        break;
       }
       return response()->json(['question'=>$question, 'eval_status'=> $evaluateStatus]);
    }

    public function EvaluationSaveResult(Request $request){
    $input = $request->all();

    $quest_id= [];
    $val = [];
    foreach ($input as $key => $value) {
      if($key === 'student_id'){
          $student_id = $value;
      }else if($key != '_token'){
        $id = preg_replace('/\D/', '', $key);
        array_push($quest_id, $id);
        array_push($val, $value);
      }
    }

    for($i = 0; $i < count($quest_id); $i++){
        $res = EvalResult::where('eq_id', $quest_id[$i])->where('student_id', session('student_id'))->first();
        if($res){
           $res->update(['res_value'=>$val[$i]]);
        }else{
        $quest = new EvalResult();
        $quest->student_id = $student_id;
        $quest->eq_id = $quest_id[$i];
        $quest->res_value = $val[$i];
        $quest->save();
        }
    }

    return response()->json(['status'=>'success']);
   }

   public function LoadEvaluationResult(Request $req){
        $result = EvalQuestion::where('eval_id', $req->eval_id)->get();

        foreach($result as $res){
            switch($res->eq_scale){
                case "5":
                    $evaluation = EvalResult::where('eq_id', $res->eq_id)->join('student_accounts', 'student_accounts.student_id', '=', 'evaluation_result.student_id')->get();
                    $res->eval_data = $evaluation;
                    break;
                case "4":
                    $eval_yes = EvalResult::where('eq_id', $res->eq_id)->where('res_value', 'yes')->get()->count();
                    $eval_no = EvalResult::where('eq_id', $req->eq_id)->where('res_value', 'no')->get()->count();
                    $res->eval_data = [$eval_yes, $eval_no];
                    break;
                default:
                    $eval_result = [];
                    for($i = 1; $i <= 5; $i++){
                        $data = EvalResult::where('eq_id', $res->eq_id)->where('res_value', $i)->get()->count();
                        $eval_result[] = $data;
                    }
                    $res->eval_data = $eval_result;
                    break;

            }
        }
        return response()->json(['data'=> $result]);
   }
}
