<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'budget_id' => 'required|exists:budget_proposals,id', 
            'committees.*.name' => 'required|string|max:255', 
            'committees.*.persons_in_charge' => 'required|array', 
            'committees.*.persons_in_charge.*' => 'required|string|max:255', 
        ]);

        foreach ($request->committees as $committee) {
            
            Committee::create([
                'name' => $committee['name'],
                'person_in_charge' => $committee['persons_in_charge'],
                'budgeting_id' => $request->budget_id, 
                
            ]);
        }

        return response()->json(['message' => 'Committees saved successfully!']);
    }

}
