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

        try {
            $response = Http::timeout(2)->asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
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
