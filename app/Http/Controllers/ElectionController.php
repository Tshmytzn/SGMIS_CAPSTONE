<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Election;

class ElectionController extends Controller
{
    public function createElection(request $request){

        if($request->election_name ==''||$request->voting_start_date ==''||$request->voting_end_date ==''){
           return response()->json(['message'=>'Fill in All Required Fields','status' => 'error']); 
        }
        
        $data = new Election;
        $data->elect_name = $request->election_name;
        $data->elect_description = $request->election_desc;
        $data->elect_start = $request->voting_start_date;
        $data->elect_end = $request->voting_end_date;
        $data->save();

        return response()->json(['message'=>'Election Successfully Created','status' => 'success']);
    }
    public function getElection(request $request){
        if($request->elect_id){
             $elect = Election::where('elect_id',$request->elect_id)->first();
              return response()->json(['data'=>$elect,'status' => 'success']);
        }
        $elect = Election::All();
        return response()->json(['data'=>$elect,'status' => 'success']);
    }
}
