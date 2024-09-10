<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertToPersianNumbers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $request->merge($this->convertPersianNumbersInArray($request->all()));
        return $next($request);
    }

    protected function convertPersianNumbersInArray(array $array)
    {
        array_walk_recursive($array, function (&$value) {
            if (is_string($value)) {
                $value = convertPersianNumbers($value);
            }
        });

        return $array;
    }
}
