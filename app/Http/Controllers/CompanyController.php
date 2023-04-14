<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
{
    public function index($id)
    {
        $company = Company::find($id);
        return view('company', ['company' => $company]);
    }

    public function all()
    {
        $companies = Company::orderBy('created_at', 'desc')->get();
        $favorites = Auth::user() ? Favorite::where('user_id', Auth::user()->id)->get() : null;
        return view('company.all', ['companies' => $companies, 'favorites' => $favorites]);
    }
}
