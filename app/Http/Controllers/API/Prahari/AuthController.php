<?php

namespace App\Http\Controllers\API\Prahari;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prahari;

class AuthController extends Controller
{
     public function signup(Request $request)
    {
        $request->validate([
            'Prahari' => 'required',
            'Mobile' => 'required|unique:praharis,Mobile',
            'Bank_account_detail' => 'required'
        ]);

        $otp = rand(1111, 9999);

        return response()->json([
            'status' => true,
            'otp' => $otp,
            'message' => 'OTP Sent Successfully'
        ]);
    }

    public function verifySignupOtp(Request $request)
    {
        $prahari = Prahari::create([
            'Prahari' => $request->Prahari,
            'Mobile' => $request->Mobile,
            'Bank_account_detail' => $request->Bank_account_detail,
            'AadhaarStatus' => 'Verified',
            'status' => 'Active'
        ]);

        $token = $prahari->createToken('API TOKEN')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Signup Successful',
            'token' => $token,
            'data' => $prahari
        ]);
    }

    public function login(Request $request)
    {
        $prahari = Prahari::where('Mobile', $request->Mobile)->first();

        if (!$prahari) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }

        $otp = rand(1111, 9999);

        return response()->json([
            'status' => true,
            'otp' => $otp,
            'message' => 'OTP Sent Successfully'
        ]);
    }

    public function verifyLoginOtp(Request $request)
    {
        $prahari = Prahari::where('Mobile', $request->Mobile)->first();

        $token = $prahari->createToken('API TOKEN')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Logged In Successfully',
            'token' => $token,
            'data' => $prahari
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged Out'
        ]);
    }
}
