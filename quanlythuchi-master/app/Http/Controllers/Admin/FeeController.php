<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeeFormRequest;
use App\Models\Household;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $fees = Fee::getAllFees();
        return view('admin.fee.index', compact('fees'));
    }

    public function show($fee)
    {
        $fee = Fee::findOrFail($fee);
        $households = Household::all();

        return view('admin.fee.show', compact('fee', 'households'));
    }

    public function create()
    {
        return view('admin.fee.create');
    }

    public function store(FeeFormRequest $request)
    {
        $validatedData = $request->validated();
        $fee = Fee::create($validatedData);
    
        return redirect('admin/fee')->with('success', 'Fee was added successfully');
    }

    public function edit($fee)
    {
        if (!$fee = Fee::findOrFail($fee)) {
            abort(404);
        }
        return view('admin.fee.edit', compact('fee'));
    }
    
    public function update($fee, FeeFormRequest $request)
    {
        $validatedData = $request->validated();
        $fee = Fee::findOrFail($fee);
    
        $fee->fill($validatedData);
    
        $fee->update();
    
        return redirect('admin/fee')->with('success', 'Fee was updated successfully');
    }
    

    public function destroy($fee)
    {
        if (!$fee = Fee::findOrFail($fee)) {
            abort(404);
        }
        $fee->delete();

        return redirect()->back()->with('success','This fee was deleted successfully');
    }
}
