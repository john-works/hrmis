<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated($request, $user)
    {
        // Check if email is verified
        if (is_null($user->email_verified_at)) {
            // Log the user out
            auth()->logout();
            
            // Generate new OTP
            $otp = rand(100000, 999999);
            
            $user->otp = $otp;
            $user->otp_expires_at = now()->addMinutes(10);
            $user->save();
            
            // Store email in session for OTP verification
            session(['otp_email' => $user->email]);
            
            // TODO: Send OTP via email
            // Mail::to($user->email)->send(new OtpMail($otp));
            
            // Redirect to OTP verification page
            return redirect()->route('password.otp.form')
                ->with('status', 'Please verify your email with the OTP sent to your email address.');
        }
        
        // Email is verified, continue to home
        return redirect()->intended($this->redirectPath());
    }
}
