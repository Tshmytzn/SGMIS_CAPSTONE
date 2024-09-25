<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use App\Models\Member;
use App\Models\Expense;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'committees' => 'required|array',
            'committees.*.name' => 'required|string',
            'committees.*.expense_types' => 'required|array',
            'committees.*.members' => 'required|array',
            'committees.*.members.*.name' => 'required|string',
            'committees.*.persons_in_charge' => 'required|array',
            'committees.*.persons_in_charge.*.name' => 'required|string',
        ]);

        // Loop through each committee
        foreach ($request->committees as $committeeData) {
            // Create the committee
            $committee = Committee::create([
                'name' => $committeeData['name'],
                'total_members' => count($committeeData['members']) + count($committeeData['persons_in_charge']),
            ]);

            // Save members
            foreach ($committeeData['members'] as $member) {
                Member::create([
                    'committee_id' => $committee->id,
                    'name' => $member['name'],
                    'is_person_in_charge' => false,
                ]);
            }

            // Save persons in charge
            foreach ($committeeData['persons_in_charge'] as $person) {
                Member::create([
                    'committee_id' => $committee->id,
                    'name' => $person['name'],
                    'is_person_in_charge' => true,
                ]);
            }

            // Save expense types
            foreach ($committeeData['expense_types'] as $expenseType) {
                Expense::create([
                    'committee_id' => $committee->id,
                    'type' => $expenseType,
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Committees saved successfully!',
            // 'reload' => 'yourReloadFunction' // Optionally specify a reload function
        ]);
    }
}
