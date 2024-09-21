<?php

namespace App\Http\Controllers;

use App\Models\SchoolEvents; 
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        // Fetch only the event_name, event_start, and event_end fields
        $events = SchoolEvents::select('event_name', 'event_start', 'event_end', 'event_pic')
            ->get();

        return view('Admin.calendar', compact('events'));
    }
}
