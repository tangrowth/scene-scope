<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function entry($id){
        $reservation = Reservation::find($id);
        $reservation -> is_used = true;
        $reservation -> save();
        return back();
    }

    public function showQrCode($id){
        $url = 'http://127.0.0.1:8000/entry/QR/'. $id;
        $qrCode = QrCode::size(300)->generate($url);

        return view('frontend.reservation.qr', compact('qrCode'));
    }

    public function showReserve($id){
        $reservation = Reservation::find($id);
        return view('backtend.reserve.user');
    }
}
