<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfilesonResponse
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
        $data = $next($request);
        if ($data instanceof JsonResponse && 
        app()->bound('debugbar') &&
        app('debugbar')->isEnabled() &&
        is_object($data->getData())
        ){
                $data->setData($data->getData(true) + ['_debugbar' => app('debugbar')->getData()]);
        }
        return $data;
    }
}
