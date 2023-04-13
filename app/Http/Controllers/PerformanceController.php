<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Reservation;
use App\Models\Company;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceController extends Controller
{
    public function index()
    {
        $performances = Performance::orderBy('created_at', 'desc')->get();
        $companies = Company::orderBy('created_at', 'desc')->get();
        $favorites = Favorite::where('user_id', Auth::user()->id)->get();
        return view('index', ['performances' => $performances, 'companies' => $companies, 'favorites' => $favorites]);
    }


    public function show($id)
    {
        if (Auth::check()){
        $performance = Performance::find($id);
        $user_id = Auth::user()->id;
        $reservations = Reservation::where('user_id', $user_id)
        ->where('performance_id', $id)
        ->get();
        return view('performance',['performance' => $performance, 'reservations' => $reservations]);
        } else {
            $performance = Performance::find($id);
            return view('performance', ['performance' => $performance]);
        }
    }

    public function search(Request $request){
        $performances = Performance::where('title', 'LIKE', "%{$request->input}%")->get();
        $companies = Company::where('name' , 'LIKE', "%{$request->input}%")->get();
        return view('index', ['performances' => $performances, 'companies' => $companies]);
    }
}
