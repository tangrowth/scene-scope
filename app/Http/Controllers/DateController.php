<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PerformanceRequest;


class DateController extends Controller
{
    public function create(PerformanceRequest $request)
    {
        $inputs = $request->all();
        return view('backend.date.create', compact('inputs'));
    }
}
