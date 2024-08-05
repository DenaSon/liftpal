<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    use LivewireAlert;
    /**
     * Handle an incoming request. -- this class check customers access
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Gate::allows('customer-access') || Gate::allows('technician'))
        {

         return $next($request);
        }
        else
        {
            $this->flash('warning', 'لطفا وارد حساب کاربری خود شوید', ['position' => 'center']);
            return redirect()->route('home', ['action' => 'login']);
        }
    }
}
