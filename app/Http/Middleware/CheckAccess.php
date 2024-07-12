<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class CheckAccess
{
    use LivewireAlert;
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Gate::allows('admin-access') || Gate::allows('author'))
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
