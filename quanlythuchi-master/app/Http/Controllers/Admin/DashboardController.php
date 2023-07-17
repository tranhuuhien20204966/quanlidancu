<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fee;
use App\Models\Person;
use App\Models\Receipt;
use App\Models\Household;
use App\Http\Controllers\Controller;
use App\Models\TemporaryResidenceAndAbsence;

class DashboardController extends Controller
{
    public function index()
    {
        $households = Household::all();
        $people = Person::all();
        $receipts = Receipt::all();
        $fees = Fee::all();
        $temporaries = TemporaryResidenceAndAbsence::all();

        $maleCount = Person::where('gender', 'male')->count();
        $femaleCount = Person::where('gender', 'female')->count();

        return view('admin/index', compact('households', 'people', 'receipts', 'fees', 'maleCount', 'femaleCount', 'temporaries'));
    }

    public function incomeChart()
    {
        $year = \Carbon\Carbon::now()->year;
        
        $items = Receipt::whereYear('created_at', $year)
        ->get()
        ->groupBy(function ($d) {
            return \Carbon\Carbon::parse($d->created_at)->format('m');
        });
        
        $result = [];
        
        foreach ($items as $month => $receipts) {
            foreach ($receipts as $receipt) {
                $amount = $receipt->amount;
                $m = intval($month);
                isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
            }
        }
        
        $data = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('F', mktime(0, 0, 0, $i, 1));
            $data[$monthName] = (!empty($result[$i])) ? number_format((float) ($result[$i]), 2, '.', '') : 0.0;
        }
        
        return $data;
    }

}
