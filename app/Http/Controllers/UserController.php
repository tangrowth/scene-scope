<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\EditPasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Performance;
use App\Models\User;


class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->where('is_used', false)->get();
        $usedReservations = Reservation::where('user_id', $user->id)->where('is_used', true)->get();
        $favorites = Favorite::where('user_id', $user->id)->get();
        $companyIds = $favorites->pluck('company_id');
        $companies = Company::whereIn('id', $companyIds)->get();
        return view('frontend.user.mypage', compact('user','reservations', 'usedReservations', 'favorites', 'companies'));
    }

    public function owner(){
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        $performances = Performance::orderBy('created_at', 'desc')->where('company_id', $company->id)->get();
        return view('backend.index', compact('performances', 'company'));
    }

    public function admin(){
        $user = Auth::user();
        return view('backend.index');
    }

    public function create(){
        return view('backend.user.create');
    }

    public function store(UserRequest $request)
    {
        $user = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        return view('backend.company.create', compact('user'));
    }

    public function edit(){
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        return view('frontend.user.edit', compact('user'));
    }

    public function update(EditUserRequest $request){
        $id = Auth::id();
        $form = $request->all();
        unset($form['_token']);
        User::find($id)->update($form);
        return redirect('/mypage');
    }

    public function editPassword(){
        return view('frontend.user.password');
    }

    public function updatePassword(EditPasswordRequest $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $newPassword = $request->input('new_password');
        $user->password = bcrypt($newPassword);
        $user->save();
        return redirect('/mypage');
    }

}
