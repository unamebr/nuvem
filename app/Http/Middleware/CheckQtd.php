<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckQtd
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
        if (Auth::user()->containers()->count() >= Auth::user()->containers) {
            return redirect('home')->with(['message' => "Você atingiu o limite de containers criado."]);
        }
        return $next($request);

    }
}
