<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait ValidatesRecaptcha
{
    /**
     * Validate the Google reCAPTCHA response token from the request.
     *
     * Returns true on success, or a redirect/JSON error response on failure.
     * Uses a 2-second timeout so a slow Google API never blocks the user for long.
     */
    protected function validateRecaptcha(Request $request): bool|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $recaptcha_response = $request->input('g-recaptcha-response');

        if (is_null($recaptcha_response) || $recaptcha_response === '') {
            $errors = ['g-recaptcha-response' => 'Please complete the reCAPTCHA to proceed'];
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'reCAPTCHA verification required',
                    'errors' => ['g-recaptcha-response' => ['Please complete the reCAPTCHA to proceed']],
                ], 422);
            }
            return redirect()->back()->withErrors($errors)->withInput();
        }

        try {
            $response = Http::timeout(2)->asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => config('services.recaptcha.secret'),
                'response' => $recaptcha_response,
                'remoteip' => $request->ip(),
            ]);

            $result = $response->json();

            if ($response->successful() && !empty($result['success'])) {
                return true;
            }

            $errors = ['g-recaptcha-response' => 'reCAPTCHA verification failed. Please try again.'];
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'reCAPTCHA verification failed',
                    'errors' => ['g-recaptcha-response' => ['Please complete the reCAPTCHA verification.']],
                ], 422);
            }
            return redirect()->back()->withErrors($errors)->withInput();

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::warning('reCAPTCHA validation timeout: ' . $e->getMessage());
            $errors = ['g-recaptcha-response' => 'reCAPTCHA timed out. Please try again.'];
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'reCAPTCHA timed out. Please try again.',
                    'errors' => ['g-recaptcha-response' => ['reCAPTCHA timed out. Please try again.']],
                ], 422);
            }
            return redirect()->back()->withErrors($errors)->withInput();

        } catch (\Exception $e) {
            Log::error('reCAPTCHA validation error: ' . $e->getMessage());
            $errors = ['g-recaptcha-response' => 'reCAPTCHA error. Please try again.'];
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'reCAPTCHA error. Please try again.',
                    'errors' => ['g-recaptcha-response' => ['reCAPTCHA error. Please try again.']],
                ], 422);
            }
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
}
