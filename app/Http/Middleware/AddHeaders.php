<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Http\JsonResponse;

class AddHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $data =  $next($request);
        if ($data instanceof JsonResponse) {
            $data->withHeaders(['Content-Type' => "application/json; charset=utf-8"]);
            $data->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return $data;
    }
}
