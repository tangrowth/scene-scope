<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PerformanceRequest;
use App\Models\Date;
use App\Models\Performance;
use Carbon\Carbon;


class DateController extends Controller
{
    public function create(PerformanceRequest $request)
    {
        $inputs = $request->all();
        return view('backend.date.create', compact('inputs'));
    }

    public function edit(Request $request)
    {
        $performance = Performance::find($request->id);
        return view('backend.performance.date', compact('performance'));
    }

    public function delete(Request $request)
    {
        Date::find($request->id)->delete();
        return redirect()->back();
    }

    public function add(Request $request)
    {
        $performances = $request->input('performance_id');
        foreach ($request->input('dates') as $index => $date) {
            $performance_id = $performances[$index];
            $datetime = Carbon::parse($date);
            $formatted_date = $datetime->format('Y/m/d H:i');
            Performance::find($performance_id)->dates()->create(['date' => $formatted_date]);
        }
        return redirect()->back();
    }

}

