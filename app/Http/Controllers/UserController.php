<?php

namespace App\Http\Controllers;

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
        return view('mypage',['user'=>$user,'reservations' => $reservations, 'favorites' => $favorites]);
    }
}
