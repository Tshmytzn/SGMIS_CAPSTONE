<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolEvents;
use App\Models\EventActivities;
use App\Models\Admin;
use App\Models\Department;
use App\Models\EventDepartment;
use App\Models\Course;

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

    public function GetAllEvents(){
        $event = SchoolEvents::all();

        return response()->json(['event'=>$event]);
    }

    public function GetEvent(Request $req){
        $id = $req->ev_id;
        $event = SchoolEvents::where('event_id', $id)->first();

        return response()->json(['event'=>$event]);
    }

    public function DeleteEvent(Request $req){
        $event_id = $req->event_id;

        $event = SchoolEvents::where('event_id', $event_id)->first();

        $image= public_path('event_images/'. $event->event_pic);
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
        $act->eact_description= $req->act_description;
        $act->save();

        $fetch = EventActivities::where('eact_id', $act->eact_id)->first();

        return response()->json(['status'=>'success', 'data'=>$fetch]);
    }

    public function GetAllEventActivities(Request $req){
        $act = EventActivities::where('event_id', $req->event_id)->get();
        return response()->json(['act'=>$act]);
    }

    public function DeleteEventActivities(Request $req){
        $act = EventActivities::where('eact_id', $req->act_id)->first();
        $act->delete();

        return response()->json(['status'=>'success']);
    }

    public function GetActDetails(Request $req){
        $act = EventActivities::where('eact_id', $req->act_id)->first();
        return response()->json(['act'=>$act]);
    }

    public function UpdateEventActivities(Request $req){
        $act = EventActivities::where('eact_id', $req->act_id)->first();
        $act->update([
          'eact_name'=>$req->act_name,
          'eact_facilitator'=>$req->act_fac,
          'eact_venue'=>$req->act_venue,
          'eact_date'=>$req->act_date,
          'eact_time'=>$req->act_time,
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
       return response()->json(['status' => 'success']);
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
        return response()->json(['programme'=>$event->event_programme]);
     }
}
