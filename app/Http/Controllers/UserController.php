<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Favorite;


class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->get();
        $favorites = Favorite::where('user_id', $user->id)->get();
        $companyIds = $favorites->pluck('company_id');
        $companies = Company::whereIn('id', $companyIds)->get();
        return view('mypage',['user'=>$user,'reservations' => $reservations, 'favorites' => $favorites, 'companies' => $companies]);
    }
}
