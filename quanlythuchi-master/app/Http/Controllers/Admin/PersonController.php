<?php

namespace App\Http\Controllers\Admin;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PersonFormRequest;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $people = Person::getAllPeople();
        return view('admin.person.index', compact('people'));
    }

    public function show($person)
    {
        if (!$person = Person::findOrFail($person)) {
            abort(404);
        }
        $changes = $person->audits;

        return view('admin.person.show', compact('person', 'changes'));
    }

    public function create()
    {
        return view('admin.person.create');
    }

    public function store(PersonFormRequest $request)
    {
        $validatedData = $request->validated();
    
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/avatar/',$filename);
            $validatedData['avatar'] = 'uploads/avatar/'.$filename;
        }
        $person = Person::create($validatedData);
    
        return redirect('admin/person')->with('success', 'Person was added successfully');
    }

    public function edit($person)
    {
        if (!$person = Person::findOrFail($person)) {
            abort(404);
        }
        return view('admin.person.edit', compact('person'));
    }
    
    public function update($person, PersonFormRequest $request)
    {
        $validatedData = $request->validated();
        $person = Person::findOrFail($person);
    
        if($request->hasFile('avatar')){
            $path = $person->avatar;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/avatar/',$filename);
            $validatedData['avatar'] = 'uploads/avatar/'.$filename;
        }


        $person->fill($validatedData);
    
        $person->update();
    
        return redirect('admin/person')->with('success', 'Person was updated successfully');
    }
    

    public function destroy($person)
    {
        if (!$person = Person::findOrFail($person)) {
            abort(404);
        }
        $path = $person->avatar;
        if (File::exists($path)) {
            File::delete($path);
        }
        $person->delete();

        return redirect()->back()->with('success','This person was deleted successfully');
    }

}
