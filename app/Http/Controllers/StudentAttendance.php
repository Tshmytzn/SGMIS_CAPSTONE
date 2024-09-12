<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\models\EventLocation;
use App\models\EventActivities;

class StudentAttendance extends Controller
{
    public function getVenueByID(Request $request) {
        // Retrieve the activity based on the provided eact_id
        $act = EventActivities::where('eact_id', $request->l_id)->first();
    
        // Check if the activity was found
        if (!$act) {
            return response()->json(['message' => 'Activity not found'], 404);
        }
    
        // Retrieve the venue based on the activity's venue ID
        $venue = EventLocation::where('l_id', $act->eact_venue)->first();
        $attendance = Attendance::where('eact_id', $act->eact_id)->where('student_id',session('student_id'))->first();
        if($attendance){
            $attend='yes';
        }else{
            $attend='no';
        }
        // Check if the venue was found
        if ($venue) {
            return response()->json(['data' => $venue,'attend'=>$attend], status: 200);
        } else {
            return response()->json(['message' => 'Venue not found'], 404);
        }
    }

    public function Attendance(Request $request){
        if($request->process == 'add'){
            $data = new Attendance;
            $data->eact_id = $request->eact_id;
            $data->student_id = session('student_id');
            $data->start = '1';
            $data->save();
            return response()->json(['message' => 'Attendance has been recorded','status'=>'success'], 200);
        }else if($request->process=='update'){
            $data = Attendance::where('eact_id',$request->eact_id)->where('student_id',session('student_id'))->first();
            $data->update([
                'end' => '1',
            ]);
            return response()->json(['message' => 'Attendance has been updated','status'=>'success']);
        }
    }
    
}
