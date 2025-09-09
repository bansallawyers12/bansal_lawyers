<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Cookie;

use App\Models\UserLog;
use App\Models\Admin;

class AgentLoginController extends Controller
{

    /**

     * Where to redirect users after login.

     *

     * @var string

     */

    protected $redirectTo = '/agent/dashboard';

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()
	{
		$this->middleware('guest:agents')->except('logout');
	}


	protected function guard()
	{
        return Auth::guard('agents');
	}

	public function showLoginForm(){
		return view('auth.agent-login');
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
	 * Validate the user login request.
	 */
	protected function validateLogin(Request $request)
	{
		$request->validate([
			'email' => 'required|string',
			'password' => 'required|string',
		]);
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
	 * Get the failed login response instance.
	 */
	protected function sendFailedLoginResponse(Request $request)
	{
		return back()->withErrors([
			'email' => 'The provided credentials do not match our records.',
		])->onlyInput('email');
	}

	/**
	 * Get the post-login redirect path.
	 */
	protected function redirectPath()
	{
		return $this->redirectTo;
	}

	public function authenticated(Request $request, $user)
	{		

		if(!empty($request->remember)) {

			\Cookie::queue(\Cookie::make('username', $request->email, 3600));

			\Cookie::queue(\Cookie::make('password', $request->password, 3600));

		} else {

			\Cookie::queue(\Cookie::forget('username'));

			\Cookie::queue(\Cookie::forget('password'));
		}
        return redirect()->intended($this->redirectPath());

    }

	public function logout(Request $request)
	{

		Auth::guard('agents')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

		return redirect('/agent/login');
	}

}
