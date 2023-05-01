<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
{
    public function index($id)
    {
        $company = Company::find($id);
        return view('frontend.company.show', compact('company'));
    }

    public function all()
    {
        $companies = Company::orderBy('created_at', 'desc')->get();
        $favorites = Auth::user() ? Favorite::where('user_id', Auth::user()->id)->get() : null;
        return view('frontend.company.index', compact('companies', 'favorites'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 1,
        ]);

        $company = Company::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'web_site_url' => $request->input('web_site_url'),
            'user_id' => $user->id,
        ]);
        return redirect('/');
    }

    public function delete(Request $request)
    {
        $company = Company::find($request->id);
        $company->performances()->delete();
        $company->user()->delete();
        $company->delete();
        return redirect('/');
    }

    public function edit(Request $request)
    {
        $company = Company::find($request->id);
        return view('backend.company.edit', compact('company'));
    }

    public function update(CompanyRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Company::find($request->id)->update($form);
        return redirect('/company/' . $request->id);
    }
}
