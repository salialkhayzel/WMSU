<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountisValid
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
        $user_details = $request->session()->all();
        $user_status = DB::table('users as u')
        ->select('u.user_status_id','us.user_status_details')
        ->join('user_status as us', 'u.user_status_id', '=', 'us.user_status_id')
        ->where('user_id','=', $user_details['user_id'])
        ->first();
        
        if(isset($user_status->user_status_details) && $user_status->user_status_details == 'deleted' ){
            return redirect('/deleted');
        }
        if(isset($user_status->user_status_details) && $user_status->user_status_details == 'inactive' ){
            if(!request()->is('inactive*')){
                return redirect('/inactive');
            }
            
        }
        return $next($request);
    }
}
