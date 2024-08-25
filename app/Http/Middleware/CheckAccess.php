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

    public function handle(Request $request, Closure $next): Response
    {

        if (Gate::allows('admin-access'))
        {
            return $next($request);
        }
        else
        {
            $this->flash('warning', 'دسترسی غیر مجاز', ['position' => 'center']);
            abort(403,'Access denied');
        }

    }
}
