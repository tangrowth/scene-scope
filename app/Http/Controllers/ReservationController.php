<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Date;
use App\Models\Performance;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function thanks()
    {
        return view('frontend.reservation.thanks');
    }

    public function create(ReservationRequest $request)
    {
        $data =array(
            'number' => $request['number'],
            'date' => Date::find($request->date_id),
            'performance' =>Performance::find($request->performance_id),
        );
        $inputs = $request->all();
        return view('frontend.reservation.confirm', compact('data', 'inputs'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $form = [
            'user_id' => $user_id, 
            'performance_id' => $request->input('performance_id'),
            'date_id' => $request->input('date_id'),
            'number' => $request->input('number'),
            'is_used' => false,
        ];
        $action = $request->input('action');
        if ($action !== '確定') {
            return redirect()
            ->route('performance', ['id' => $form['performance_id']]);
        } else {
            $date = Date::find($form['date_id']);
            $date->reserved = $date->reserved + $form['number'];
            $date->save();
            Reservation::create($form);
            return redirect()->route('reserve.thanks');
        }
    }

    public function cancel(Request $request){
        $reservation = Reservation::find($request->id);
        $reservation -> is_canceled = false;
        $reservation->save();
        return back();
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return back();
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->admin){
            $performances = Performance::withCount('reservations') -> get();
        } else {
            $company_id = Company::where('user_id', $user->id) -> first() -> id;
            $performances = Performance::where('company_id', $company_id)-> withCount('reservations')-> get();
        }
        return view ('backend.reservation.index', compact('performances'));
    }

    public function show(Request $request)
    {
        $performance = Performance::find($request->performance_id);
        $dates = $performance->dates;
        $reservationsByDate = [];
        foreach ($dates as $date) {
            $reservations = Reservation::where('performance_id', $request->performance_id)
                ->where('date_id', $date->id)
                ->get();

            $reservationsByDate[$date->id] = $reservations;
        }
        return view('backend.reservation.show', compact('performance', 'reservationsByDate', 'dates'));
    }


}
