<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\IpUtils;

class AdminAuthenticatedSessionController extends Controller
{
    /**
     * Display the admin login view.
     */
    public function create(): View
    {
        return view('auth.admin-login');
    }

    /**
     * Handle an incoming admin authentication request.
     */
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        // Validate reCAPTCHA before authentication
        $recaptchaResponse = $this->validateRecaptcha($request);
        if ($recaptchaResponse !== true) {
            return $recaptchaResponse;
        }

        $request->authenticate();
        $request->session()->regenerate();

        // Handle post-authentication logic
        $this->handleAdminLogin($request);

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log logout activity
        $this->logUserActivity($request, 'Logged out successfully', 'info');

        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin');
    }

    /**
     * Validate reCAPTCHA response
     */
    private function validateRecaptcha(Request $request): bool|RedirectResponse
    {
        $recaptcha_response = $request->input('g-recaptcha-response');
        
        if (is_null($recaptcha_response)) {
            $errors = ['g-recaptcha-response' => 'Please Complete the Recaptcha to proceed'];
            return redirect()->back()->withErrors($errors);
        }

        $url = "https://www.google.com/recaptcha/api/siteverify";
        $body = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $recaptcha_response,
            'remoteip' => IpUtils::anonymize($request->ip())
        ];

        $response = Http::get($url, $body);
        $result = json_decode($response);

        if ($response->successful() && $result->success == true) {
            return true;
        } else {
            $errors = ['g-recaptcha-response' => 'Please Complete the Recaptcha Again to proceed'];
            return redirect()->back()->withErrors($errors);
        }
    }

    /**
     * Handle post-authentication logic
     */
    private function handleAdminLogin(Request $request): void
    {
        $user = Auth::guard('admin')->user();

        // Handle remember me cookies
        if (!empty($request->remember)) {
            Cookie::queue(Cookie::make('email', $request->email, 3600));
            Cookie::queue(Cookie::make('password', $request->password, 3600));
        } else {
            Cookie::queue(Cookie::forget('email'));
            Cookie::queue(Cookie::forget('password'));
        }

        // Check for new IP address and send notification
        $this->checkNewIpAddress($request, $user);

        // Log successful login
        $this->logUserActivity($request, 'Logged in successfully', 'info', $user->id);
    }

    /**
     * Check for new IP address and send notification
     */
    private function checkNewIpAddress(Request $request, $user): void
    {
        if (!\App\Models\UserLog::where('ip_address', '=', $request->getClientIp())->exists()) {
            $message = '<html><body>';
            $message .= '<p>Dear Admin,</p>';
            $message .= '<p>CRM traced new IP Address- ' . $request->getClientIp() . ' from Email- ' . $user->email . '</p>';
            $message .= '<table>
                            <tr><td><b>IP Address: </b>' . $request->getClientIp() . '</td></tr>
                            <tr><td><b>Name: </b>' . $user->first_name . '</td></tr>
                            <tr><td><b>Email: </b>' . $user->email . '</td></tr>
                        </table>';
            $message .= '</body></html>';
            
            $subject = 'CRM Traced new IP Address- ' . $request->getClientIp() . ' from Email- ' . $user->email;
            
            $this->send_compose_template(
                'info@bansaleducation.au', 
                $subject, 
                'info@bansaleducation.au', 
                $message, 
                'Bansal Immigration'
            );
        }
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

    /**
     * Send compose template email (inherited from base Controller)
     */
    protected function send_compose_template($to, $subject, $sender, $content, $sendername, $array = array(), $cc = array())
    {
        $explodeTo = explode(';', $to);
        $q = \Illuminate\Support\Facades\Mail::to($explodeTo);
        
        if (!empty($cc)) {
            $q->cc($cc);
        }
        
        $q->send(new \App\Mail\CommonMail($content, $subject, $sender, $sendername, $array));

        if (\Illuminate\Support\Facades\Mail::flushMacros()) {
            return false;
        }

        return true;
    }
}
