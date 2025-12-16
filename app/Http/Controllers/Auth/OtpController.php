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
     * @return \Illuminate\Http\Response
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        $otpRecord = Otp::where('email', $request->email)
                        ->where('otp', $request->otp)
                        ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'Invalid OTP.'], 400);
        }

        // Check if OTP is expired (valid for 10 minutes)
        $otpCreationTime = Carbon::parse($otpRecord->created_at);
        if (Carbon::now()->diffInMinutes($otpCreationTime) > 10) {
            return response()->json(['message' => 'OTP has expired.'], 400);
        }

        // OTP is valid, proceed with your logic (e.g., mark user as verified)
        // ...

        // Optionally, delete the OTP record after successful verification
        $otpRecord->delete();

        return response()->json(['message' => 'OTP verified successfully.'], 200);
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