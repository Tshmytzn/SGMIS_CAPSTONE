<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
    
        // Check if the venue was found
        if ($venue) {
            return response()->json(['data' => $venue], 200);
        } else {
            return response()->json(['message' => 'Venue not found'], 404);
        }
    }
    
}
