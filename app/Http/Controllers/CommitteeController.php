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
            'committees.*.name' => 'required|string|max:255', // Validate committee name
            'committees.*.persons_in_charge' => 'required|array', // Ensure it's an array
            'committees.*.persons_in_charge.*' => 'required|string|max:255', // Validate each person in charge
        ]);

        // Save each committee
        foreach ($request->committees as $committee) {
            Committee::create([
                'name' => $committee['name'],
                'person_in_charge' => $committee['persons_in_charge'],
            ]);
        }

        return response()->json(['message' => 'Committees saved successfully!']);
    }

}
