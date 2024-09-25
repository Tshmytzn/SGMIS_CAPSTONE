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
            // Initialize the query for EventActivities
            $activityQuery = EventActivities::where('event_id', $request->event_id);

            // Conditionally filter by 'act_id' if provided
            if (!empty($request->act_id)) {
                $activityQuery->where('eact_id', $request->act_id);
            }

            // Get the list of activities
            $activities = $activityQuery->get();

            // Initialize data array
            $data = [];

            foreach ($activities as $act) {
                // Get attendance related to the activity
                $attendances = Attendance::where('eact_id', $act->eact_id)->get();

                foreach ($attendances as $attendance) {
                    // Fetch related entities in one go for better performance
                    $schoolevent = SchoolEvents::where('event_id', $request->event_id)
                        ->select('event_name')
                        ->first();

                    $department = Department::where('dept_id',$request->dept_id)
                        ->select('dept_id', 'event_name') // You need 'dept_id' for the Course lookup
                        ->first();

                    // Ensure a department exists before querying its courses
                    if ($department) {
                        $course = Course::where('course_id',$request->course_id)
                            ->select('course_id', 'course_name') // You need 'course_id' for Section lookup
                            ->first();

                        // Ensure a course exists before querying its sections
                        if ($course) {
                            $section = Section::where('sect_id', $request->sect_id)
                                ->select('sect_id', 'sect_name', 'year_level') // You need 'sect_id' for student lookup
                                ->first();

                            // Ensure a section exists before querying its students
                            if ($section) {
                                $student = StudentAccounts::where('student_id',operator: $attendance->student_id)
                                    ->select('student_id', 'student_name')
                                    ->first();
                            }
                        }
                    }

                    // Add the fetched data into a single array object for easier use
                    $data[] = [
                        'event_name' => $schoolevent->event_name ?? null,
                        'department' => $department->dept_name ?? null,
                        'course_name' => $course->course_name ?? null,
                        'section' => $section->sect_name ?? null,
                        'year_level' => $section->year_level ?? null,
                        'student_id' => $student->student_id ?? null,
                        'student_name' => $student->student_name ?? null,
                    ];
                }
            }

            // Return the data as JSON
            return response()->json(['data' => $data, 'status' => 'success']);

        }
        return response()->json(['message' => 'Attendance has been updated', 'status' => 'success']);
    }
}
