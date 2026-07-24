<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::orderBy('period_number')->get();
        return view('admin.periods.index', compact('periods'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'period_number' => 'required|integer|min:1',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'is_break' => 'nullable|boolean',
        ]);
        $data['is_break'] = $request->boolean('is_break');
        Period::create($data);
        return back()->with('status', 'Period added.');
    }

    public function destroy(Period $period)
    {
        $period->delete();
        return back()->with('status', 'Period removed.');
    }
}
