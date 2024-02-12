<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountisStudent
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
        if(isset($user_details['user_id'])){
            $this->user_details = DB::table('users as u')
            ->select(
                'user_role_details')
            ->join('user_roles as ur', 'u.user_role_id', '=', 'ur.user_role_id')
            ->where('user_id','=', $user_details['user_id'])
            ->first();
        }
        
        if(isset($this->user_details->user_role_details) && $this->user_details->user_role_details == 'student'){
            return redirect('/student/profile');
        }
        return $next($request);
    }
}
