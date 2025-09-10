<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AgentLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class AgentAuthenticatedSessionController extends Controller
{
    /**
     * Display the agent login view.
     */
    public function create(): View
    {
        return view('auth.agent-login');
    }

    /**
     * Handle an incoming agent authentication request.
     */
    public function store(AgentLoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Handle post-authentication logic
        $this->handleAgentLogin($request);

        return redirect()->intended(route('agent.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log logout activity
        $this->logUserActivity($request, 'Logged out successfully', 'info');

        Auth::guard('agents')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/agent/login');
    }

    /**
     * Handle post-authentication logic
     */
    private function handleAgentLogin(Request $request): void
    {
        $user = Auth::guard('agents')->user();

        // Handle remember me cookies
        if (!empty($request->remember)) {
            Cookie::queue(Cookie::make('username', $request->email, 3600));
            Cookie::queue(Cookie::make('password', $request->password, 3600));
        } else {
            Cookie::queue(Cookie::forget('username'));
            Cookie::queue(Cookie::forget('password'));
        }

        // Log successful login
        $this->logUserActivity($request, 'Logged in successfully', 'info', $user->id);
    }

    /**
     * Log user activity
     */
    private function logUserActivity(Request $request, string $message, string $level, $userId = null): void
    {
        $obj = new \App\Models\UserLog;
        $obj->level = $level;
        $obj->user_id = $userId;
        $obj->ip_address = $request->getClientIp();
        $obj->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $obj->message = $message;
        $obj->save();
    }
}
