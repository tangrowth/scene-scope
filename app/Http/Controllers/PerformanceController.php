<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Reservation;
use App\Models\Company;
use App\Models\User;
use App\Models\Date;
use Illuminate\Http\Request;
use App\Http\Requests\PerformanceRequest;
use App\Http\Requests\PerformanceEditRequest;
use Illuminate\Support\Facades\Auth;
use InterventionImage;
use Illuminate\Support\Facades\Storage;

class PerformanceController extends Controller
{
    public function index()
    {
        $performances = Performance::latest()->take(4)->get();
        $companies = Company::latest()->take(4)->get();
        return view('index', compact('performances', 'companies'));
    }
    
    public function all()
    {
        $performances = Performance::latest()->paginate(12);
        $title = "全ての公演";
        $input = '';
        return view('frontend.performance.index', compact('performances', 'title', 'input'));
    }

    public function search(Request $request)
    {
        $performances = Performance::latest()->where('title', 'LIKE', "%{$request->input}%")->paginate(12);
        $title = '公演　検索結果';
        $input = $request->input;
        return view('frontend.performance.index', compact('performances', 'title', 'input'));
    }

    public function show($id)
    {
        $performance = Performance::find($id);
        $dates = Date::where('performance_id', $id)->orderBy('start_date')->get();
        if (Auth::check()) {
            $reservations = Reservation::where('user_id', Auth::id())
            ->whereHas('date', function ($query) use ($id) {
                $query->where('performance_id', $id);
            })
            ->get();
            return view('frontend.performance.show', compact('performance', 'dates', 'reservations'));
        } else {
            return view('frontend.performance.show', compact('performance', 'dates'));
        }
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
            $filename = time() . '1.png';
            $image->save($filePath . '/' . $filename);
            $inputs['img_url'] = 'storage/temporary/' . $filename;
        }
        if($request->hasFile('top_img_url')){
            $file = $request->file('top_img_url');
            $filePath = public_path('storage/temporary');
            $filename = time() . '2.png';
            $file->move($filePath, $filename);
            $inputs['top_img_url'] = 'storage/temporary/' . $filename;
        }
        $dates['date'] = $request->input('dates');
        $capacities = $request->input('capacities');
        $dateCapacities = [];
        foreach ($dates['date'] as $index => $date) {
            $capacity = $capacities[$index];
            $dateCapacities[] = [
                'date' => $date,
                'capacity' => $capacity,
            ] ;
        }
        return view('backend.performance.confirm', compact('inputs', 'dateCapacities'));
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
            'capacity' => $request->input('capacity'),
            'company_id' => $company_id
        ];
        $action = $request->input('action');
        if ($action !== '公演を作成する') {
            if ($request->has('top_img_url')) {
                $temporaryImagePath2 = public_path($request->input('top_img_url'));
                if (file_exists($temporaryImagePath2)) {
                    unlink($temporaryImagePath2);
                }
            }
            if ($request->has('img_url')) {
                $temporaryImagePath1 = public_path($request->input('img_url'));
                if (file_exists($temporaryImagePath1)) {
                    unlink($temporaryImagePath1);
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
            if ($request->has('top_img_url')) {
                $topImagePath = public_path($request->input('top_img_url'));
                $uploadedTopImagePath = 'performance/top/' . time() . '.png';
                Storage::disk('s3')->put($uploadedTopImagePath, file_get_contents($topImagePath));
                if (file_exists($topImagePath)) {
                    unlink($topImagePath);
                }
                $s3BucketUrl = Storage::disk('s3')->url('/');
                $s3BucketUrl = rtrim(Storage::disk('s3')->url('/'), '/');
                $form['top_img_url'] = $s3BucketUrl . '/' . $uploadedTopImagePath;
            } else {
                $form['top_img_url'] = null;
            }
            $performance = Performance::create($form);
            $dates = $request->input('dates');
            $capacities = $request->input('capacities');
            $dateCapacities = [];
            foreach ($dates as $index => $date) {
                $capacity = $capacities[$index];
                $dateCapacities[] = [
                    'start_date' => $date,
                    'capacity' => $capacity,
                    'performance_id' => $performance->id,
                ];
            }
            Date::insert($dateCapacities);
            return redirect()->route('owner');
        }
    }


    public function delete(Request $request)
    {
        Performance::find($request->id)->delete();
        $user = Auth::user();
        if ($user->role === 1) {
            return redirect('/admin/owner');
        } else {
            return redirect('/admin');
        }
    }

    public function edit(Request $request)
    {
        $performance = Performance::find($request->id);
        return view('backend.performance.edit', compact('performance'));
    }

    public function update(PerformanceEditRequest $request)
    {
        $performance = Performance::find($request->id);
        if ($request->hasFile('img_url')) {
            $uploadedImage = $request->file('img_url');
            $resizedImage = InterventionImage::make($uploadedImage)
                ->orientate()
                ->fit(900, 600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            $uploadedImagePath = 'performance/' . time() . '.' . $uploadedImage->getClientOriginalExtension();
            Storage::disk('s3')->put($uploadedImagePath, $resizedImage->stream());
            if ($performance->img_url) {
                Storage::disk('s3')->delete(basename($performance->img_url));
            }
            $s3BucketUrl = rtrim(Storage::disk('s3')->url('/'), '/');
            $s3BucketUrl = rtrim(Storage::disk('s3')->url('/'), '/');
            $img_url = $s3BucketUrl . '/' . $uploadedImagePath;
        } else {
            $img_url = $performance->img_url;
        }
        $form = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'address' => $request->input('address'),
            'venue' => $request->input('venue'),
            'web_site_url' => $request->input('web_site_url'),
            'img_url' => $img_url,
        ];
        Performance::find($request->id)->update($form);
        return redirect('/performance/' . $request->id);
    }
}
