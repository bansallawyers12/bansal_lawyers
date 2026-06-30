<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait ValidatesTurnstile
{
    /**
     * Validate the Cloudflare Turnstile response token from the request.
     *
     * Returns true on success, or a redirect/JSON error response on failure.
     */
    protected function validateTurnstile(Request $request): bool|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $token = $request->input('cf-turnstile-response');

        if (! is_string($token) || $token === '') {
            $errors = ['cf-turnstile-response' => 'Please complete the security verification to proceed'];
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Security verification required',
                    'errors' => ['cf-turnstile-response' => ['Please complete the security verification to proceed']],
                ], 422);
            }

            return redirect()->back()->withErrors($errors)->withInput();
        }

        $secret = config('services.turnstile.secret');
        if (! is_string($secret) || $secret === '') {
            Log::error('Turnstile secret key is not configured');
            $errors = ['cf-turnstile-response' => 'Security verification is temporarily unavailable. Please try again later.'];
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Security verification is temporarily unavailable. Please try again later.',
                ], 503);
            }

            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Cloudflare "always pass" test secret — skip remote verify (common on local XAMPP).
        if ($secret === '1x0000000000000000000000000000000AA') {
            return true;
        }

        try {
            $http = Http::timeout(5);

            // Local Windows/XAMPP often lacks a CA bundle for Guzzle; allow verify only in production.
            if (app()->environment('local')) {
                $http = $http->withOptions(['verify' => false]);
            }

            $response = $http->asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret'   => $secret,
                'response' => $token,
                'remoteip' => $request->ip(),
            ]);

            $result = $response->json();

            if ($response->successful() && ! empty($result['success'])) {
                return true;
            }

            $errors = ['cf-turnstile-response' => 'Security verification failed. Please try again.'];
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Security verification failed',
                    'errors' => ['cf-turnstile-response' => ['Please complete the security verification again.']],
                ], 422);
            }

            return redirect()->back()->withErrors($errors)->withInput();

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::warning('Turnstile validation timeout: '.$e->getMessage());
            $errors = ['cf-turnstile-response' => 'Security verification timed out. Please try again.'];
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Security verification timed out. Please try again.',
                    'errors' => ['cf-turnstile-response' => ['Security verification timed out. Please try again.']],
                ], 422);
            }

            return redirect()->back()->withErrors($errors)->withInput();

        } catch (\Exception $e) {
            Log::error('Turnstile validation error: '.$e->getMessage());
            $errors = ['cf-turnstile-response' => 'Security verification error. Please try again.'];
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Security verification error. Please try again.',
                    'errors' => ['cf-turnstile-response' => ['Security verification error. Please try again.']],
                ], 422);
            }

            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
}
