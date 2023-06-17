<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogAfterRequest
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        Log::info('mobile', [
            'uri' => $request->getRequestUri(),
            'request' => $request->all(),
            'response' => $response
        ]);
    }
}
