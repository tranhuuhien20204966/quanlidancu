<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::getAllUsers();
        return view('admin.user.index', compact('users'));
    }

    public function show($user)
    {
        if (!$user = User::findOrFail($user)) {
            abort(404);
        }

        return view('admin.user.show', compact('user'));
    }

    public function create()
    {
        $people = Person::all();
        return view('admin.user.create', compact('people'));
    }

    public function store(UserFormRequest $request)
    {
        $validatedData = $request->validated();

        // Retrieve the Person record along with its related data
        $personId = $validatedData['personId'];
        $person = Person::findOrFail($personId);
        
        // Create the user using the person relationship
        $user = $person->user()->create([
            'personId' => $personId,
            'name' => $person->name,
            'email' => $person->email,
            'password' => Hash::make('1111'),
            'status' => $validatedData['status']
        ]);
    
        return redirect('admin/user')->with('success', 'User was added successfully');
    }

    public function edit($user)
    {
        $user = User::findOrFail($user);
        $people = Person::all();     
        
        return view('admin.user.edit', compact('user', 'people'));
    }
    
    public function update($user, UserFormRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::findOrFail($user);
    
        $user->fill($validatedData);
        $validatedData['userId'] = Auth::user()->id;
    
        $user->update();
    
        return redirect('admin/user')->with('success', 'User was updated successfully');
    }
    

    public function destroy($user)
    {
        if (!$user = User::findOrFail($user)) {
            abort(404);
        }
        $user->delete();

        return redirect()->back()->with('success','This user was deleted successfully');
    }
}
