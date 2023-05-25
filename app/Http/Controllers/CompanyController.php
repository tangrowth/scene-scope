<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Auth;
use InterventionImage;
use Illuminate\Support\Facades\Storage;


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

    public function confirm(Request $request)
    {
        $inputs = $request->all();
        if ($request->hasFile('img_url')) {
            $image = InterventionImage::make($request->file('img_url'));
            $image->orientate();
            $image->fit(900, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $filePath = public_path('storage/temporary');
            $filename = time() . '.png';
            $image->save($filePath . '/' . $filename);
            $inputs['img_url'] = 'storage/temporary/' . $filename;
        }
        return view('backend.company.confirm', compact('inputs'));
    }

    public function store(Request $request)
    {
        if ($request->action !== '劇団を作成する') {
            if ($request->has('img_url')) {
                $temporaryImagePath = public_path($request->input('img_url'));
                if (file_exists($temporaryImagePath)) {
                    unlink($temporaryImagePath);
                }
            }
            return redirect()->route('admin.create');
        }else{
            if ($request->has('img_url')) {
                $imagePath = public_path($request->input('img_url'));
                $uploadedImagePath = 'copmany/' . time() . '.png';
                Storage::disk('s3')->put($uploadedImagePath, file_get_contents($imagePath));
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $s3BucketUrl = Storage::disk('s3')->url('/');
                $s3BucketUrl = rtrim(Storage::disk('s3')->url('/'), '/');
                $img_url = $s3BucketUrl . '/' . $uploadedImagePath;
            }
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
                'img_url' => $img_url,
            ]);
            return redirect('/');
        }
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
