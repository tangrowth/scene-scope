<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        $performances = Performance::orderBy('created_at', 'desc')->get();
        return view('index',['performances'=>$performances]);
    }

    public function show($id)
    {
        $performance = Performance::find($id);
        return view('performance',['performance' => $performance]);
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
