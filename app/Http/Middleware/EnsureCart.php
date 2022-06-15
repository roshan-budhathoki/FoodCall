<?php

namespace App\Http\Middleware;
use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;

class EnsureCart
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
        $cart = Cart::where('user_id', session('user'))->first();
        if(!$cart){
            return redirect('/');
        } 
        return $next($request); 
    }
}
