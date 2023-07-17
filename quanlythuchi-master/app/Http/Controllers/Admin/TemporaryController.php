<?php

namespace App\Http\Controllers\Admin;

use App\Models\Person;
use App\Models\Household;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TemporaryFormRequest;
use App\Models\TemporaryResidenceAndAbsence;

class TemporaryController extends Controller
{
    public function index(Request $request)
    {
        $temporaries = TemporaryResidenceAndAbsence::getAllTemporaryResidenceAndAbsence();
        return view('admin.temporary.index', compact('temporaries'));
    }

    public function show($temporary)
    {
        if (!$temporary = TemporaryResidenceAndAbsence::findOrFail($temporary)) {
            abort(404);
        }

        return view('admin.temporary.show', compact('temporary'));
    }

    public function create()
    {
        $people = Person::all();
        return view('admin.temporary.create', compact('people'));
    }

    public function store(TemporaryFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['userId'] = Auth::user()->id;
        $temporary = TemporaryResidenceAndAbsence::create($validatedData);
    
        return redirect('admin/temporary')->with('success', 'TemporaryResidenceAndAbsence was added successfully');
    }

    public function edit($temporary)
    {
        if (!$temporary = TemporaryResidenceAndAbsence::findOrFail($temporary)) {
            abort(404);
        }
        $people = Person::all();
        return view('admin.temporary.edit', compact('temporary', 'people'));
    }
    
    public function update($temporary, TemporaryFormRequest $request)
    {
        $validatedData = $request->validated();
        $temporary = TemporaryResidenceAndAbsence::findOrFail($temporary);
    
        $temporary->fill($validatedData);
        $validatedData['userId'] = Auth::user()->id;
    
        $temporary->update();
    
        return redirect('admin/temporary')->with('success', 'TemporaryResidenceAndAbsence was updated successfully');
    }
    

    public function destroy($temporary)
    {
        if (!$temporary = TemporaryResidenceAndAbsence::findOrFail($temporary)) {
            abort(404);
        }
        $temporary->delete();

        return redirect()->back()->with('success','This temporary was deleted successfully');
    }

    public function getHouseholdId(Request $request)
    {
        $personId = $request->input('personId');
    
        // Fetch the householdId based on the personId
        $householdId = Person::find($personId)->household->householdId;
    
        return response()->json(['householdId' => $householdId]);
    }    
}
