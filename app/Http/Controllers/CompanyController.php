<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Performance;
use Illuminate\Support\Facades\Auth;
use InterventionImage;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    public function show($id)
    {
        $company = Company::find($id);
        $performances = Performance::where('company_id', $id)->latest()->get();
        $favorite = Favorite::where('user_id', Auth::id())->where('company_id', $id)->first();
        $user_id = Auth::id();
        return view('frontend.company.show', compact('company', 'performances', 'favorite','user_id'));
    }

    public function all()
    {
        $companies = Company::latest()->paginate(12);
        $title = '劇団一覧';
        $input = '';
        return view('frontend.company.index', compact('companies', 'title', 'input'));
    }

    public function search(Request $request)
    {
        $companies = Company::where('name', 'LIKE', "%{$request->input}%")->latest()->paginate(12);
        $title = '劇団　検索結果';
        $input = $request->input;
        return view('frontend.company.index', compact('companies', 'title', 'input'));
    }

    public function confirm(CompanyRequest $request)
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
                $uploadedImagePath = 'company/' . time() . '.png';
                Storage::disk('s3')->put($uploadedImagePath, file_get_contents($imagePath));
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $s3BucketUrl = Storage::disk('s3')->url('/');
                $s3BucketUrl = rtrim(Storage::disk('s3')->url('/'), '/');
                $img_url = $s3BucketUrl . '/' . $uploadedImagePath;
            } else {
                $img_url = null;
            }
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => 1,
                'email_verified_at' => now(),
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
        $company = Company::find($request->id);
        if ($request->hasFile('img_url')) {
            $uploadedImage = $request->file('img_url');
            $resizedImage = InterventionImage::make($uploadedImage)
            ->orientate()
            ->fit(900, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $uploadedImagePath = 'company/' . time() . '.' . $uploadedImage->getClientOriginalExtension();
            Storage::disk('s3')->put($uploadedImagePath, $resizedImage->stream());
            if ($company->img_url) {
                Storage::disk('s3')->delete(basename($company->img_url));
            }
            $s3BucketUrl = rtrim(Storage::disk('s3')->url('/'), '/');
            $s3BucketUrl = rtrim(Storage::disk('s3')->url('/'), '/');
            $img_url = $s3BucketUrl . '/' . $uploadedImagePath;
        } else {
            $img_url = $company->img_url;
        }
        $requestDate = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'web_site_url' => $request->input('web_site_url'),
            'img_url' => $img_url,
        ];
        $company->update($requestDate);
        return redirect()->route('company', ['id'=>$request->id]);
    }
}
