<?php

namespace App\Http\Controllers\Admin;

use App\Models\Person;
use App\Models\Receipt;
use App\Models\Household;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReceiptFormRequest;
use App\Models\Fee;

class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        $receipts = Receipt::getAllReceipts();
        return view('admin.receipt.index', compact('receipts'));
    }

    public function show($receipt)
    {
        if (!$receipt = Receipt::findOrFail($receipt)) {
            abort(404);
        }

        return view('admin.receipt.show', compact('receipt'));
    }

    public function create()
    {
        $people = Person::all();
        $households = Household::all();
        $fees = Fee::all();
        return view('admin.receipt.create', compact('people', 'households', 'fees'));
    }

    public function store(ReceiptFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['userId'] = Auth::user()->id;
        $receipt = Receipt::create($validatedData);
    
        return redirect('admin/receipt')->with('success', 'Receipt was added successfully');
    }

    public function edit($receipt)
    {
        $receipt = Receipt::findOrFail($receipt);
        $people = Person::all();
        $households = Household::all();
        $fees = Fee::all();
        return view('admin.receipt.edit', compact('people', 'households', 'fees', 'receipt'));
    }
    
    public function update($receipt, ReceiptFormRequest $request)
    {
        $validatedData = $request->validated();
        $receipt = Receipt::findOrFail($receipt);
    
        $receipt->fill($validatedData);
        $validatedData['userId'] = Auth::user()->id;
    
        $receipt->update();
    
        return redirect('admin/receipt')->with('success', 'Receipt was updated successfully');
    }
    

    public function destroy($receipt)
    {
        if (!$receipt = Receipt::findOrFail($receipt)) {
            abort(404);
        }
        $receipt->delete();

        return redirect()->back()->with('success','This receipt was deleted successfully');
    }

}
