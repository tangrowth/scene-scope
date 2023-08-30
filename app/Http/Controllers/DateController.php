<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DateRequest;
use App\Http\Requests\EditDateRequest;
use App\Http\Requests\PerformanceRequest;
use App\Models\Date;
use App\Models\Performance;


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
        $dates = Date::where('performance_id', $performance->id)->orderBy('start_date')->get();
        return view('backend.performance.date', compact('performance', 'dates'));
    }

    public function update(EditDateRequest $request)
    {
        $form = $request->only(['capacity']);
        Date::find($request->id)->update($form);
        return back();
    }

    public function delete(Request $request)
    {
        Date::find($request->id)->delete();
        return redirect()->back();
    }

    public function add(DateRequest $request)
    {
        $form = $request->all();
        Date::create($form);
        return redirect()->back();
    }

}

