<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\ElectionParty;

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
    public function party(request $request){
    
    if($request->method ==='add'){
       if($request->party_name ==''||$request->party_desc =='' || $request->party_image==''){
        return response()->json(['message' => 'Fill Out Required Field', 'status' => 'error']);
       }
        // Handle the uploaded file
            if ($request->hasFile('party_image')) {
                $image = $request->file('party_image');

                // Store the image in the 'public/party_image' directory
                

                // Extract the original name and extension, then combine them
                $imageNameWithExtension = $image->getClientOriginalName(); // Image name with extension
                $request->party_image->move(public_path('party_image/'), $imageNameWithExtension); // Save file and return path
                // Save data to the database
                $data = new ElectionParty;
                $data->elect_id = $request->elect_id;
                $data->party_name = $request->party_name;
                $data->party_description = $request->party_desc;
                $data->party_picture = $imageNameWithExtension; // Store the full name with extension
                $data->save();

                return response()->json(['message' => 'Party Successfully Created','reload' => 'getParty', 'status' => 'success']);
                }

    }else if($request->method ==='get'){
        $party = ElectionParty::All();
        return response()->json(['data'=>$party,'status' => 'success']);
    }else if($request->method ==='delete'){
        $party = ElectionParty::where('party_id',$request->party_id)->first();
        $party->delete();
        return response()->json(['message' => 'Party Successfully Deleted','reload' => 'getParty', 'status' => 'success']);
    }
     return response()->json(['message' => 'Process failed', 'status' => 'error'], 400);
    }
}
