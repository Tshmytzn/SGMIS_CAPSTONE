<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SchoolEvents;
use Illuminate\Http\Request;
use App\models\EventLocation;
use App\models\EventActivities;
use App\models\EventDepartment;
use Carbon\Carbon;

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
        $attendance2 = Attendance::where('eact_id', $act->eact_id)->where('student_id', session('student_id'))->where('end','=','1')->first();
        if($attendance2){
            $attend = 'already';
        }
        else if($attendance){
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
            $act = EventActivities::where('eact_id', $request->eact_id)->first();
            $timezone = 'Asia/Hong_Kong';
            $currentTime = Carbon::now($timezone)->format('H:i'); // Get the current date and time
            $currentTime12 = Carbon::now($timezone)->format('h:i A');
            $currentDate = Carbon::now($timezone)->format('Y-m-d');
            // Compare event time with current time
            $start = $act->eact_time;
            $newTime = Carbon::createFromFormat('H:i', time: $start)->addMinutes(30)->format('H:i');
            
            if($currentDate > $act->eact_date){
                return response()->json(['message' => 'Event has ended', 'status' => 'error']);
            }else if($currentDate < $act->eact_date){
                return response()->json(['message' => 'Event has not started yet', 'status' =>'error']);
            }
            else if ($act->eact_time > $currentTime ) { // Check if event time is greater than current time
                return response()->json(['message' => 'Event has not started yet', 'status' => 'error']);
            }else if($act->eact_time < $currentTime && $act->eact_end < $currentTime){
                return response()->json(['message' => 'Event has ended', 'status' => 'error']);
            }else if($newTime < $currentTime){
                return response()->json(['message' => 'Time in ended', 'status' => 'error']);
            }
            $data = new Attendance;
            $data->eact_id = $request->eact_id;
            $data->student_id = session('student_id');
            $data->start = '1';
            $data->time_in = $currentTime12;
            $data->save();
            return response()->json(['message' => 'Attendance has been recorded','status'=>'success'], 200);
            }else if($request->process=='update'){
            $act = EventActivities::where('eact_id', $request->eact_id)->first();
            $timezone = 'Asia/Hong_Kong';
            $currentTime = Carbon::now($timezone)->format('H:i');
            $currentTime12 = Carbon::now($timezone)->format('h:i A');
            $currentDate = Carbon::now($timezone)->format('Y-m-d');
            $end = $act->eact_end;
            $newTime = Carbon::createFromFormat('H:i', $end)->addMinutes(15)->format('H:i');
            if ($currentDate > $act->eact_date) {
                return response()->json(['message' => 'Event has ended', 'status' => 'error']);
            } else if ($currentDate < $act->eact_date) {
                return response()->json(['message' => 'Event has not started yet', 'status' => 'error']);
            } else if ($act->eact_end > $currentTime) {
                return response()->json(['message' => 'Time out available in '. $act->eact_end, 'status' => 'error']);
            }
            else if ($newTime < $currentTime) {
                return response()->json(['message' => 'Event Ended', 'status' => 'error']);
            }
            $data = Attendance::where('eact_id',$request->eact_id)->where('student_id',session('student_id'))->first();
            $data->update([
                'end' => '1',
                'time_out' => $currentTime12,
            ]);
            return response()->json(['message' => 'Attendance has been updated','status'=>'success']);
        }
    }
    public function getAttendance(Request $request){
        if($request->getAttendance=='Act'){
            $event = EventActivities::where('event_id',$request->event_id)->select('eact_id','eact_name')->get();
            return response()->json(['data' => $event, 'status' => 'success']);
        }
        return response()->json(['message' => 'Attendance has been updated', 'status' => 'success']);
    }
}
