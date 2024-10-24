<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SchoolEvents;
use Illuminate\Http\Request;
use App\models\EventLocation;
use App\models\EventActivities;
use App\models\EventDepartment;
use App\Models\Department;
use App\Models\Course;
use App\Models\Section;
use App\Models\StudentAccounts;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
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

            $imageData = $request->input('photo');

            // Remove the "data:image/png;base64," part of the base64 string
            $imageParts = explode(";base64,", $imageData);
            $imageType = explode("image/", $imageParts[0])[1]; // Extract the image type (e.g., 'png', 'jpeg')
            $imageBase64 = base64_decode($imageParts[1]); // Decode the base64 image

            $fileName = uniqid() . '.' . $imageType;

            // Define the file path where the image will be saved
            $filePath = public_path('student_attendance/') . $fileName;

            // Save the decoded image to the file path
            file_put_contents($filePath, $imageBase64);

            $data = new Attendance;
            $data->eact_id = $request->eact_id;
            $data->student_id = session('student_id');
            $data->start = '1';
            $data->time_in = $currentTime12;
            $data->in_proof = $fileName;
            $data->save();
            return response()->json(['message' => 'Attendance has been recorded','status'=>'success'], 200);
            }else if($request->process=='update'){
            $act = EventActivities::where('eact_id', $request->eact_id)->first();
            $timezone = 'Asia/Hong_Kong';
            $currentTime = Carbon::now($timezone)->format('H:i');
            $currentTime12 = Carbon::now($timezone)->format('h:i A');
            $currentDate = Carbon::now($timezone)->format('Y-m-d');
            $end = $act->eact_end;
            $dateTime = Carbon::createFromFormat('H:i', $end);
            $time12 = $dateTime->format('h:i A');
            $newTime = Carbon::createFromFormat('H:i', $end)->addMinutes(15)->format('H:i');
            if ($currentDate > $act->eact_date) {
                return response()->json(['message' => 'Event has ended', 'status' => 'error']);
            } else if ($currentDate < $act->eact_date) {
                return response()->json(['message' => 'Event has not started yet', 'status' => 'error']);
            } else if ($act->eact_end > $currentTime) {
                return response()->json(['message' => 'Time out available in '. $time12, 'status' => 'error']);
            }
            else if ($newTime < $currentTime) {
                return response()->json(['message' => 'Event Ended', 'status' => 'error']);
            }

            $imageData = $request->input('photo');

            // Remove the "data:image/png;base64," part of the base64 string
            $imageParts = explode(";base64,", $imageData);
            $imageType = explode("image/", $imageParts[0])[1]; // Extract the image type (e.g., 'png', 'jpeg')
            $imageBase64 = base64_decode($imageParts[1]); // Decode the base64 image

            $fileName = uniqid() . '.' . $imageType;

            // Define the file path where the image will be saved
            $filePath = public_path('student_attendance/') . $fileName;

            // Save the decoded image to the file path
            file_put_contents($filePath, $imageBase64);

            $data = Attendance::where('eact_id',$request->eact_id)->where('student_id',session('student_id'))->first();
            $data->update([
                'end' => '1',
                'time_out' => $currentTime12,
                'out_proof' => $fileName,
            ]);
            return response()->json(['message' => 'Attendance has been updated','status'=>'success']);
        }
    }
    public function getAttendance(Request $request){
        if($request->getAttendance=='Act'){
            $event = EventActivities::where('event_id',$request->event_id)->select('eact_id','eact_name')->get();
            $dept = EventDepartment::where('event_id',$request->event_id)->get();
            $data = [];
            foreach ($dept as $key => $value) {
                $department =  Department::where('dept_id',$value->dept_id)->first();
                $data[]= $department;
            }

            return response()->json(['Act' => $event,'Dept'=> $data, 'status' => 'success']);
        }else if($request->getAttendance == 'Course'){
            $course = Course::where('dept_id',$request->dept_id)->select('course_id','course_name')->get();
            return response()->json(['Course' =>$course, 'status' => 'success']);
        }else if ($request->getAttendance == 'Section'){
            $section = Section::where('course_id',$request->course_id)->select('sect_id','sect_name','year_level')->get();
            return response()->json(['Section' => $section, 'status' => 'success']);
        }else if($request->getAttendance=='Attendance'){
            $activityQuery = EventActivities::where('event_id', $request->event_id);
            if (!empty($request->act_id)) {
                $activityQuery->where('eact_id', $request->act_id);
            }
            $activities = $activityQuery->get();
            $data = [];

            foreach ($activities as $act) {
                $attendances = Attendance::where('eact_id', $act->eact_id)->get();
                if ($attendances) {
                    foreach($attendances as $attend){
                        $schoolevent = SchoolEvents::where('event_id', $request->event_id)
                        ->select('event_name')
                        ->first();
                        $department = Department::where('dept_id', $request->dept_id)
                        ->select('dept_name', 'dept_id') // You need 'dept_id' for the Course lookup
                        ->first();
                        $course = Course::where('course_id', $request->course_id)
                        ->where('dept_id', $department->dept_id)
                        ->select('course_name', 'course_id') // You need 'course_id' for Section lookup
                        ->first();
                        $section = Section::where('sect_id', $request->sect_id)
                        ->where('course_id', $course->course_id)
                        ->select('sect_name', 'year_level', 'sect_id') // You need 'sect_id' for student lookup
                        ->first();
                        $student = StudentAccounts::where('student_id', $attend->student_id)
                        ->where('sect_id', $section->sect_id)
                        ->select('school_id', 'student_firstname', 'student_middlename', 'student_lastname')
                        ->first();
                        if ($student) {
                            $data[] = [
                                'activity' => $act->eact_name,
                                'attendance' => $attend,
                                'event' => $schoolevent,
                                'dept' => $department,
                                'course' => $course,
                                'section' => $section->year_level . '-' . $section->sect_name,
                                'student' => $student,
                            ];
                        }
                    }
                }
            }

            // Return the data as JSON
            return response()->json(['data' => $data, 'status' => 'success']);

        }
        return response()->json(['message' => 'Attendance has been updated', 'status' => 'success']);
    }
}
