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
use Carbon\Carbon;
use InterventionImage;
use Illuminate\Support\Facades\Storage;

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
        if (Auth::check()) {
            $performance = Performance::find($id);
            $user_id = Auth::user()->id;
            $reservations = Reservation::where('user_id', $user_id)
                ->where('performance_id', $id)
                ->get();
            return view('frontend.performance.show', compact('performance', 'reservations'));
        } else {
            $performance = Performance::find($id);
            return view('frontend.performance.show', compact('performance'));
        }
    }

    public function search(Request $request)
    {
        $performances = Performance::where('title', 'LIKE', "%{$request->input}%")->get();
        $companies = Company::where('name', 'LIKE', "%{$request->input}%")->get();
        $favorites = Auth::user() ? Favorite::where('user_id', Auth::user()->id)->get() : null;
        return view('index', compact('performances', 'companies', 'favorites'));
    }

    public function create()
    {
        return view('backend.performance.create');
    }


    public function confirm(PerformanceRequest $request)
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
            'zip' => $request->input('zip'),
            'address' => $request->input('address'),
            'venue' => $request->input('venue'),
            'web_site_url' => $request->input('web_site_url'),
            'company_id' => $company_id
        ];
        $action = $request->input('action');
        if ($action !== '公演を作成する') {
            if ($request->has('img_url')) {
                $temporaryImagePath = public_path($request->input('img_url'));
                if (file_exists($temporaryImagePath)) {
                    unlink($temporaryImagePath);
                }
            }
            return redirect()->route('performance.create');
        } else {
            if ($request->has('img_url')) {
                $imagePath = public_path($request->input('img_url'));
                $uploadedImagePath = 'performance/' . time() . '.png';
                Storage::disk('s3')->put($uploadedImagePath, file_get_contents($imagePath));
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $s3BucketUrl = Storage::disk('s3')->url('/');
                $s3BucketUrl = rtrim(Storage::disk('s3')->url('/'), '/');
                $form['img_url'] = $s3BucketUrl . '/' . $uploadedImagePath;
            } else {
                $form['img_url'] = null;
            }
            $performance = Performance::create($form);
            foreach ($request->input('dates') as $date) {
                $datetime = Carbon::parse($date);
                $formatted_date = $datetime->format('Y/m/d H:i');
                $performance->dates()->create(['date' => $formatted_date]);
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
