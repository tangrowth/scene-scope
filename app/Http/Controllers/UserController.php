<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Performance;


class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->get();
        $favorites = Favorite::where('user_id', $user->id)->get();
        $companyIds = $favorites->pluck('company_id');
        $companies = Company::whereIn('id', $companyIds)->get();
        return view('frontend.mypage', compact('user','reservations', 'favorites', 'companies'));
    }

    public function admin(){
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        $performances = Performance::orderBy('created_at', 'desc')->where('company_id', $company->id)->get();
        return view('backend.index', compact('performances'));
    }

    public function create(){
        return view('backend.user.create');
    }

    public function store(UserRequest $request)
    {
        $user = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 100, 
        ];
        return view('backend.company.create', compact('user'));
    }
}
