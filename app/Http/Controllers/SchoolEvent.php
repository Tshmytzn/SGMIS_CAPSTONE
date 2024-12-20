<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SetSemester;
use Illuminate\Http\Request;
use App\Models\SchoolEvents;
use App\Models\EventActivities;
use App\Models\Admin;
use App\Models\Department;
use App\Models\EventDepartment;
use App\Models\Course;
use App\Models\EvalQuestion;
use App\Models\Evaluation;
use App\Models\EventLocation;
use App\Models\StudentAccounts;
use App\Models\Section;
use App\Models\Liquidation;
class SchoolEvent extends Controller
{
    public function SaveEvent(Request $req){
        $pic = $req->file('ev_pic');

        if(!in_array($pic->getClientOriginalExtension(), ['jpeg', 'jpg', 'png', 'gif'])){
            return response()->json(['status'=>'invalid_img']);
        }
        $event = new SchoolEvents;
        $event->event_name  = $req->ev_name;
        $event->event_description = $req->ev_description;
        $event->event_start = $req->ev_start;
        $event->event_end = $req->ev_end;
        $event->event_facilitator = $req->ev_facilitator;
        $event->event_pic = 'none';
        $event->admin_id = session('admin_id');
        $event->save();

        $picName = 'Event'.$event->event_id .".". $pic->getClientOriginalExtension();
        $pic->move(public_path('event_images/'), $picName);

        $eventUpdate = SchoolEvents::where('event_id', $event->event_id)->first();
        $eventUpdate->update(['event_pic'=>$picName]);

        return response()->json(['status'=>'success', 'ev_id'=>$event->event_id]);
    }

    public function GetAllEvents(Request $req){
        if($req->where == 'admin' || $req->where == 'student_admin'){
            $event = SchoolEvents::all();
        }else{

            $student = StudentAccounts::where('student_id', session('student_id'))->first();
            $section = Section::where('sect_id', $student->sect_id)->first();
            $course = Course::where('course_id', $section->course_id)->first();
            $department = Department::where('dept_id', $course->dept_id)->first();

            $event = SchoolEvents::where('event_status', 1)->join('event_departments', 'event_departments.event_id', '=', 'school_event.event_id')->where('event_departments.dept_id', $department->dept_id)->get();

        }

        return response()->json(['event'=>$event]);
    }

    public function GetEvent(Request $req){
        $id = $req->ev_id;
        $event = SchoolEvents::where('event_id', $id)->first();

        return response()->json(['event'=>$event]);
    }

    public function DeleteEvent(Request $req){
        $event_id = $req->event_id;
        $dept = EventDepartment::where('event_id', $event_id)->get();
        if($dept){
            foreach($dept as $d){
                $d->delete();
            }
        }
        $act = EventActivities::where('event_id', $event_id)->get();
        if($act){
            foreach($act as $a){
                $a->delete();
            }
        }
        $eval = Evaluation::where('event_id', $event_id)->first();

        if($eval){
            $evalQ= EvalQuestion::where('eval_id', $eval->eval_id)->get();
            foreach($evalQ as $q){
                $q->delete();
            }
            $eval->delete();
        }
        $event = SchoolEvents::where('event_id', $event_id)->first();
        $image= public_path('event_images/'. $event->event_pic);
        if($event->event_programme != null){
            $programme = explode(',', $event->event_programme);
            foreach($programme as $prog){
                $p_image = public_path('programme_images/'. $prog);
                if(file_exists($p_image)){
                    unlink($p_image);
                }
            }
        }
        if(file_exists($image)){
            unlink($image);
            $event->delete();
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'fail']);
        }
    }

    public function EventDetailsLoad(Request $req){
        $ev_id = $req->event_id;
        $event = SchoolEvents::where('event_id', $ev_id)->first();
        $admin = Admin::where('admin_id', $event->admin_id)->first();

        return response()->json(['event'=>$event, 'admin'=>$admin]);
    }

    public function UpdateEventDetails(Request $req){
        $event = SchoolEvents::where('event_id', $req->event_id)->first();

        $pic = $req->file('ev_pic');

        if($pic) {
            if(!in_array($pic->getClientOriginalExtension(), ['jpeg', 'jpg', 'png', 'gif'])){
                return response()->json(['status'=>'invalid_img']);
            }else{
                $event->update([
                    'event_name'=> $req->ev_name,
                    'event_description'=>$req->ev_description,
                    'event_facilitator'=> $req->ev_facilitator,
                    'event_start'=> $req->ev_start,
                    'event_end'=>$req->ev_end,
                    'event_pic'=> "Event". $req->event_id .".".$pic->getClientOriginalExtension(),
                  ]);

                  $pic->move(public_path('event_images/'),  "Event". $req->event_id . ".". $pic->getClientOriginalExtension());
            }
        }
         $event->update([
           'event_name'=> $req->ev_name,
           'event_description'=>$req->ev_description,
           'event_facilitator'=> $req->ev_facilitator,
           'event_start'=> $req->ev_start,
           'event_end'=>$req->ev_end,
         ]);
    }

    public function AddEventActivity(Request $req){

        $act = new EventActivities;
        $act->event_id = $req->event_id;
        $act->eact_name = $req->act_name;
        $act->eact_facilitator = $req->act_fac;
        $act->eact_venue = $req->act_venue;
        $act->eact_date = $req->act_date;
        $act->eact_time = $req->act_time;
        $act->eact_end = $req->end_act_time;
        $act->eact_description= $req->act_description;
        $act->save();

        $fetch = EventActivities::where('eact_id', $act->eact_id)->first();

        return response()->json(['status'=>'success', 'data'=>$fetch]);
    }

    public function GetAllEventActivities(Request $req){
        $act = EventActivities::where('event_id', $req->event_id)
            ->join('event_location', 'event_activities.eact_venue', '=', 'event_location.l_id')
            ->select('event_activities.*', 'event_location.location_name as location_name', 'event_location.l_id as l_id')
            ->get();
        return response()->json(['act'=>$act]);
    }

    public function DeleteEventActivities(Request $req){
        $act = EventActivities::where('eact_id', $req->act_id)->first();
        $act->delete();

        return response()->json(['status'=>'success']);
    }

    public function GetActDetails(Request $req)
    {
        $act = EventActivities::where('eact_id', $req->act_id)
            ->join('event_location', 'event_activities.eact_venue', '=', 'event_location.l_id')
            ->select('event_activities.*', 'event_location.location_name as location_name', 'event_location.l_id as l_id')
            ->first();
        return response()->json(['act' => $act]);
    }

    public function UpdateEventActivities(Request $req){
        $act = EventActivities::where('eact_id', $req->act_id)->first();
        $act->update([
          'eact_name'=>$req->act_name,
          'eact_facilitator'=>$req->act_fac,
          'eact_venue'=>$req->act_venue,
          'eact_date'=>$req->act_date,
          'eact_time'=>$req->act_time,
          'eact_end' => $req->act_end,
          'eact_description'=>$req->act_description,
        ]);

        return response()->json(['status'=>'success', 'data'=>$req->act_id]);
    }

    public function UploadProgrammeImages(Request $req) {
      $images= $req->file('programmeImages');
      $name =  $req->event_id . "-" .RandId(15). ".". $images->getClientOriginalExtension();
      $images->move(public_path('programme_images/'),$name);
      $event = SchoolEvents::where('event_id', $req->event_id)->first();
      $current = $event->event_programme;
      $current .= $name . ",";
      $event->update([
         'event_programme'=> $current,
      ]);
       return response()->json(['status' => 'success', 'event_id'=>$req->event_id, 'img'=>$name]);
    }

    public function AddDeptEvent(Request $req){
       $dept = new EventDepartment();
       $dept->event_id = $req->event_id;
       $dept->dept_id =$req->dept_id;
       $dept->status = 0;
       $dept->save();

       $department = Department::where('dept_id', $req->dept_id)->first();
       $course = Course::where('dept_id', $req->dept_id)->get();

       return response()->json(['status'=>'success', 'dept'=>$department, 'course'=>$course]);
    }
    public function RemoveDeptEvent(Request $req){
        $dept = EventDepartment::where('event_id', $req->event_id)->where('dept_id', $req->dept_id)->first();
        $dept->delete();

        $event = EventDepartment::where('event_id', $req->event_id)->get()->count();
        return response()->json(['status'=>'success', 'dept'=>$event]);
    }

    public function GetDeptEvent(Request $req){
       $dept = EventDepartment::where('event_id', $req->event_id)->get();
       return response()->json(['dept'=>$dept]);
    }

    public function GetDepartment(Request $req){
        $dept = Department::where('dept_id', $req->dept_id)->first();
        return response()->json(['dept'=>$dept]);
     }
     public function GetCourse(Request $req){
        $course = Course::where('dept_id', $req->dept_id)->get();
        return response()->json(['course'=>$course]);
     }

     public function GetProgrammeList(Request $req){
        $event = SchoolEvents::where('event_id', $req->event_id)->first();
        return response()->json(['programme'=>$event->event_programme, 'event_id'=>$req->event_id]);
     }

     public function RemoveProgramme(Request $req){
       $programme = SchoolEvents::where('event_id', $req->event_id)->first();
       $list = explode(',', $programme->event_programme);
       $newList = '';
       foreach ($list as $prog){
        if($prog !== ''){
          if($prog !== $req->programme_name){
            $newList .= $prog.',';
          }
        }
       }

       $image = public_path('programme_images/'. $req->programme_name);
       if(file_exists($image)){
        unlink($image);
        $programme->update([
          'event_programme'=> $newList,
        ]);
       }

       return response()->json(['status'=>'success', 'programme'=>$req->programme_name, 'list'=>$newList]);
     }
     public function SubmitEventVenue(request $request){
        if($request->venue==''){
            return  response()->json(['status'=>'error', 'message'=>'Please put a venue name!']);
        }
        $data = new EventLocation;
        $data->location_name = $request->venue;
        $data->latitude = $request->lat;
        $data->longitude = $request->lng;
        $data->lrange = $request->rangeRadius;
        $data->save();
        return response()->json(['message'=>'Venue Successfully Added','status' => 'success']);
     }
     public function GetVenue(request $request){
        $venue = EventLocation::all();
        return response()->json(['data' => $venue]);
     }
     public function updateVenue(request $request){
        $venue = EventLocation::where('l_id', $request->venueID)->first();
        $venue->update([
          'location_name'=>$request->venue,
          'latitude'=>$request->lat,
          'longitude'=>$request->lng,
          'lrange'=>$request->rangeRadius,
        ]);
        return response()->json(['message'=>'Venue Successfully Updated','status' => 'success']);
     }
     public function deleteVenue(request $request){
        $venue =  EventLocation::where('l_id', $request->v_id)->first();
        $venue->delete();
        return response()->json(['message'=>'Venue Successfully Deleted','status' => 'success']);
     }

     public function PublishEvent(Request $req){
        $event = SchoolEvents::where('event_id', $req->eventId)->first();

        $semester = SetSemester::first();

        if (($event->event_start >= $semester->first_start && $event->event_start <= $semester->first_end) &&
            ($event->event_end >= $semester->first_start && $event->event_end <= $semester->first_end)
        ) {
            // Event is within the first semester
            $result = '1st Sem';
        }
        // Else, check if event is within the second semester
        elseif (($event->event_start >= $semester->second_start && $event->event_start <= $semester->second_end) &&
            ($event->event_end >= $semester->second_start && $event->event_end <= $semester->second_end)
        ) {
            // Event is within the second semester
            $result = '2nd Sem';
        }

        $data = new Liquidation;
        $data->event_id = $event->event_id;
        $data->liquidation_name = $event->event_name.' Liquidation';
        $data->semester = $result;
        $data->date_from = $event->event_start;
        $data->date_to = $event->event_end;
        $data->Save();

        if($event->event_status == 1){
            $status = 0;
            $message = "Event is successfully Unpublished";
            $publish = "Unpublish";
        }else{
            $status = 1;
            $message = "Event is successfully Published";
            $publish = 'Publish';
        }
        $event->update([
            'event_status' => $status
        ]);

        return response()->json(['success'=> true, 'status'=> $publish, 'message'=> $message]);
     }
}
