<?php

namespace App\Http\Middleware;

use App\Models\Date;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckReservationAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');
        $date = Date::find($id);

        if( $date && $date->performance->company->user_id == Auth::id() ){
            return $next($request);
        } else {
            return back();
        }

    }
}
