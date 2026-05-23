<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToWww
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->getHost() === 'bansallawyers.com.au') {
            return redirect()->to(
                'https://www.bansallawyers.com.au'.$request->getRequestUri(),
                301
            );
        }

        return $next($request);
    }
}
