<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function add(Request $request){
        $user_id = Auth::id();
        $form = [
            'user_id' => $user_id,
            'company_id' => $request->input('company_id')
        ];
        Favorite::create($form);
        return back();
    }

    public function delete($id)
    {
        $favorite = Favorite::find($id);
        $favorite->delete();
        return back();
    }
}
