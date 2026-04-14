<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateAppointmentsApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $configured = config('services.appointments_api.token');

        if (! is_string($configured) || $configured === '') {
            abort(401, 'Unauthorized');
        }

        $provided = $request->bearerToken()
            ?? $request->header('X-Appointments-Api-Token');

        if (! is_string($provided) || ! hash_equals($configured, $provided)) {
            abort(401, 'Unauthorized');
        }

        return $next($request);
    }
}
