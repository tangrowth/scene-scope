<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Reservation;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceController extends Controller
{
    public function index()
    {
        $performances = Performance::orderBy('created_at', 'desc')->get();
        $companies = Company::orderBy('created_at', 'desc')->get();
        return view('index',['performances' => $performances, 'companies' => $companies]);
    }

    public function show($id)
    {
        if (Auth::check()){
        $performance = Performance::find($id);
        $user_id = Auth::user()->id;
        $reservation = Reservation::where('user_id', $user_id)
        ->where('performance_id', $id)
        ->first();
        return view('performance',['performance' => $performance, 'reservation' => $reservation]);
        } else {
            $performance = Performance::find($id);
            return view('performance', ['performance' => $performance]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function edit(Performance $performance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Performance $performance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance $performance)
    {
        //
    }
}
