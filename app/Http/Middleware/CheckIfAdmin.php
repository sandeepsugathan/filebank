<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request - allow access only for admin users.
     *
     * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! Auth::user()->isAdmin()) {
            return redirect(route('home'))->with('alertMessage', [
                'class' => 'danger',
                'message' => 'You are not authorised to view this page',
            ]);
        }
        return $next($request);
    }
}
