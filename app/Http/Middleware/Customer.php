<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Illuminate\Support\Facades\Session;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->session()->has('customer')){
            if(\URL::previous() == route('shop.index')){
                Session::put('visiting_shop','yes');
            }
            flash()->error('Please login first');
            return redirect()->route('customer.login');
        }
        return $next($request);
    }
}
