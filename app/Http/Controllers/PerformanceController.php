<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Reservation;
use App\Models\Company;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PerformanceRequest;
use Illuminate\Support\Facades\Auth;

class PerformanceController extends Controller
{
    public function index()
    {
        $performances = Performance::orderBy('created_at', 'desc')->take(4)->get();
        $companies = Company::orderBy('created_at', 'desc')->take(4)->get();
        $favorites = Auth::user() ? Favorite::where('user_id', Auth::user()->id)->get() : null;
        return view('index', compact('performances', 'companies', 'favorites'));
    }

    public function all()
    {
        $performances = Performance::orderBy('created_at', 'desc')->get();
        return view('frontend.performance.index', compact('performances'));
    }


    public function show($id)
    {
        if (Auth::check()){
        $performance = Performance::find($id);
        $user_id = Auth::user()->id;
        $reservations = Reservation::where('user_id', $user_id)
        ->where('performance_id', $id)
        ->get();
        return view('frontend.performance.show',compact('performance', 'reservations'));
        } else {
            $performance = Performance::find($id);
            return view('frontend.performance.show', compact('performance'));
        }
    }

    public function search(Request $request){
        $performances = Performance::where('title', 'LIKE', "%{$request->input}%")->get();
        $companies = Company::where('name' , 'LIKE', "%{$request->input}%")->get();
        $favorites = Auth::user() ? Favorite::where('user_id', Auth::user()->id)->get() : null;
        return view('index', compact('performances', 'companies', 'favorites'));
    }

    public function create(){
        return view('backend.performance.create');
    }

    public function confirm(PerformanceRequest $request){
        $inputs = $request->all();
        return view('backend.performance.confirm', compact('inputs'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $company_id = User::find($user_id)->company->id;
        $form = [
            'user_id' => $user_id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'venue' => $request->input('venue'),
            'web_site_url' => $request->input('web_site_url'),
            'company_id' => $company_id
        ];
        $action = $request->input('action');
        if ($action !== '公演を作成する') {
            return redirect()
                ->route('performance.create');
        } else {
            $performance = Performance::create($form);
            foreach ($request->input('dates') as $date) {
                $performance->dates()->create(['date' => $date]);
            }
            return redirect()->route('owner');
        }
    }

    public function delete(Request $request)
    {
        Performance::find($request->id)->delete();
        return back();
    }

    public function edit(Request $request)
    {
        $performance = Performance::find($request->id);
        return view('backend.performance.edit', compact('performance'));
    }

    public function update(PerformanceRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Performance::find($request->id)->update($form);
        return redirect('/performance/' . $request->id);
    }
}
