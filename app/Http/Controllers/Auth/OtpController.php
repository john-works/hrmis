<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;   
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class OtpController extends Controller
{
    /**
     * Handle the OTP verification request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        // Get email from session (set during registration)
        $email = session('otp_email');
        
        if (!$email) {
            return back()->with('error', 'Session expired. Please register again.');
        }

        // Find user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        // Check if OTP matches
        if ($user->otp !== $request->otp) {
            return back()->with('error', 'Invalid OTP code.');
        }

        // Check if OTP is expired
        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->with('error', 'OTP has expired. Please request a new one.');
        }

        // OTP is valid - verify the user's email and clear OTP
        $user->email_verified_at = now();
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Clear session
        session()->forget('otp_email');

        // Log the user in
        auth()->login($user);

        return redirect()->route('home')->with('status', 'Email verified successfully! Welcome aboard.');
    }

    /**
     * Resend OTP to user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendOtp(Request $request)
    {
        $email = session('otp_email');
        
        if (!$email) {
            return response()->json(['error' => 'Session expired. Please register again.'], 400);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Generate new OTP
        $otp = rand(100000, 999999);
        
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        // TODO: Send OTP via email
        // Mail::to($user->email)->send(new OtpMail($otp));

        return response()->json(['status' => 'A new OTP has been sent to your email.'], 200);
    }

    /**
     * Create a new user instance after validation.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}