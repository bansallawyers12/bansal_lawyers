<?php
namespace App\Http\Controllers\Auth;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Cookie;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\IpUtils;

class AdminLoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
	
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     */
    protected function credentials(Request $request)
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password' => $request->get('password'), 'status' => 1];
        }
        return ['username' => $request->get('email'), 'password' => $request->get('password'), 'status' => 1];
    }

    /**
     * Send the response after the user was authenticated.
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->authenticated($request, $this->guard()->user());

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the post-login redirect path.
     */
    protected function redirectPath()
    {
        return $this->redirectTo;
    }
	
    protected function guard()
	{
        return Auth::guard('admin');
    }
    
    
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
        'email' => 'required|string',
        'password' => 'required|string',
        'g-recaptcha-response' => 'required',
        ]);
    }
	
	/*public function authenticated(Request $request, $user)
    {		
		if(!empty($request->remember)) {
			\Cookie::queue(\Cookie::make('email', $request->email, 3600));
			\Cookie::queue(\Cookie::make('password', $request->password, 3600));
		} else {
			\Cookie::queue(\Cookie::forget('email'));
			\Cookie::queue(\Cookie::forget('password'));
		}
	
		$obj = new \App\UserLog;
		$obj->level = 'info';
		$obj->user_id = @$user->id;
		$obj->ip_address = $request->getClientIp();
		$obj->user_agent = $_SERVER['HTTP_USER_AGENT'];
		$obj->message = 'Logged in successfully';
		$obj->save();
        return redirect()->intended($this->redirectPath());
    }*/
    
    public function authenticated(Request $request, $user)
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
            'remoteip' => IpUtils::anonymize($request->ip()) //anonymize the ip to be GDPR compliant. Otherwise just pass the default ip address
        ];

        $response = Http::get($url, $body); //dd($response);
        $result = json_decode($response); //dd($result);

        if ($response->successful() && $result->success == true) { 
            if(!empty($request->remember)) {
                \Cookie::queue(\Cookie::make('email', $request->email, 3600));
                \Cookie::queue(\Cookie::make('password', $request->password, 3600));
            } else {
                \Cookie::queue(\Cookie::forget('email'));
                \Cookie::queue(\Cookie::forget('password'));
            }
          
             if(! \App\Models\UserLog::where('ip_address', '=', $request->getClientIp() )->exists())
            {
                $message  = '<html><body>';
                $message .= '<p>Dear Admin,</p>';
                $message .= '<p>CRM traced new IP Address- '.$request->getClientIp().' from Email- '.$user->email.'</p>';
                $message .= '<table>
                                <tr><td><b>IP Address: </b>'.$request->getClientIp().'</td></tr>
                                <tr><td><b>Name: </b>'.$user->first_name.'</td></tr>
                                <tr><td><b>Email: </b>'.$user->email.'</td></tr>
                            </table>';
                $message .= '</body></html>';
                $subject = 'CRM Traced new IP Address- '.$request->getClientIp().' from Email- '.$user->email;
                $this->send_compose_template('info@bansaleducation.au', $subject, 'info@bansaleducation.au', $message,'Bansal Immigration');
            }


            $obj = new \App\UserLog;
            $obj->level = 'info';
            $obj->user_id = @$user->id;
            $obj->ip_address = $request->getClientIp();
            $obj->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $obj->message = 'Logged in successfully';
            $obj->save();
            return redirect()->intended($this->redirectPath());
        } else { 
            $errors = ['g-recaptcha-response' => 'Please Complete the Recaptcha Again to proceed'];
            return redirect()->back()->withErrors($errors);
        }
    }
	
	 protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];
  
        // Load user from database
        $user = \App\Models\User::where($this->username(), $request->{$this->username()})->first();
    
        if ($user && !\Hash::check($request->password, $user->password)) {
            $errors = ['password' => 'Wrong password'];
        }
    
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
       
         if(! \App\Models\UserLog::where('ip_address', '=', $request->getClientIp() )->exists())
         {
           $message  = '<html><body>';
           $message .= '<p>Dear Admin,</p>';
           $message .= '<p>CRM traced new IP Address- '.$request->getClientIp().' from Email- '.$user->email.'</p>';
           $message .= '<table>
                                <tr><td><b>IP Address: </b>'.$request->getClientIp().'</td></tr>
                                <tr><td><b>Name: </b>'.$user->first_name.'</td></tr>
                                <tr><td><b>Email: </b>'.$user->email.'</td></tr>
                            </table>';
           $message .= '</body></html>';
           $subject = 'CRM Traced new IP Address- '.$request->getClientIp().' from Email- '.$user->email;
           $this->send_compose_template('info@bansaleducation.au', $subject, 'info@bansaleducation.au', $message,'Bansal Immigration');
         }

       
		$obj = new \App\UserLog;
		$obj->level = 'critical';
		$obj->user_id = @$user;
		$obj->ip_address = $request->getClientIp();
		$obj->user_agent = $_SERVER['HTTP_USER_AGENT'];
		$obj->message = 'Invalid Email or Password !';
		$obj->save();
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
	
	public function logout(Request $request)
    {
		  $user = $request->id;
	
		$obj = new \App\UserLog;
		$obj->level = 'info';
		$obj->user_id = @$user;
		$obj->ip_address = $request->getClientIp();
		$obj->user_agent = $_SERVER['HTTP_USER_AGENT'];
		$obj->message = 'Logged out successfully';
		$obj->save();
		Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
		
		return redirect('/admin');
    }
}
