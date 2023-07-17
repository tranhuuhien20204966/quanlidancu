<?php

namespace App\Http\Controllers\Admin;

use App\Models\Person;
use App\Models\Household;
use Illuminate\Http\Request;
use App\Models\HouseholdMember;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\HouseholdFormRequest;

class HouseholdController extends Controller
{
    public function index(Request $request)
    {
        $households = Household::getAllHouseholds();
        return view('admin.household.index', compact('households'));
    }

    public function show($id)
    {
        $household = Household::findOrFail($id);
        $members = $household->members()->get();

        return view('admin.household.show', compact('household', 'members'));
    }

    public function create()
    {
        $households = Household::all();
        $householdMembers = $households->pluck('members.*.personId')->flatten()->toArray();
        $people = Person::whereNotIn('id', $householdMembers)->get();
        
        return view('admin.household.create', compact('people'));        
    }

    public function store(Request $request)
    {
        $request->validate(['address' => 'required|string']);
            
        // Create the household
        $household = Household::create([
            'address' => $request->address,
        ]);
    
        $request->validate([
            'personId' => 'required|array',
            'personId.*' => 'required|unique:household_members,personId,NULL,id,householdId,' . $household->id,
            'relationship' => 'required|array',
            'relationship.*' => 'required',
            'isOwner' => 'required|array',
            'isOwner.*' => 'boolean|unique:household_members,isOwner,NULL,id,householdId,' . $household->id,
        ]);

        // Loop through each person and associate with the household
        foreach ($request->personId as $index => $personId) {
            $relationship = $request->relationship[$index];
            $isOwner = $request->isOwner[$index] ?? false;
    
            $household->members()->create([
                'householdId' => $household->id,
                'personId' => $personId,
                'relationship' => $relationship,
                'isOwner' => $isOwner,
            ]);
        }
    
        return redirect('admin/household')->with('success', 'Household was added successfully');
    }

    public function edit($id)
    {
        $households = Household::all();
        $householdMembers = $households->pluck('members.*.personId')->flatten()->toArray();
        
        $people = Person::whereNotIn('id', $householdMembers)->get();
        
        $household = Household::findOrFail($id);
        $members = $household->members()->with('person')->get();
        
        $people = $people->concat($members->pluck('person'));
        
        
        return view('admin.household.edit', compact('household', 'members', 'people'));
    }
    
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'address' => 'required|string',
            'personId' => 'required|array',
            'personId.*' => 'required',
            'relationship' => 'required|array',
            'relationship.*' => 'required',
            'isOwner' => 'required|array',
            'isOwner.*' => 'boolean',
        ]);
    
        $household = Household::findOrFail($id);
    
        // Update the household address
        $household->update([
            'address' => $request->address,
        ]);
    
        // Delete existing household members
        $household->members()->delete();
    
        // Loop through each person and associate with the household
        foreach ($request->personId as $index => $personId) {
            $relationship = $request->relationship[$index];
            $isOwner = $request->isOwner[$index] ?? false;
    
            $household->members()->create([
                'householdId' => $household->id,
                'personId' => $personId,
                'relationship' => $relationship,
                'isOwner' => $isOwner,
            ]);
        }
    
        return redirect('admin/household')->with('success', 'Household was updated successfully');
    }
    

    public function destroy($id)
    {
        $household = Household::findOrFail($id);

        // Delete all associated household members
        $household->members()->delete();

        // Delete the household
        $household->delete();

        return redirect('admin/household')->with('success', 'Household was deleted successfully');
    }

}