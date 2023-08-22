<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function entry($id){
        $reservation = Reservation::find($id);
        $reservation -> is_used = true;
        $reservation -> save();
        return back();
    }
}
