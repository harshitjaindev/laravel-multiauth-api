<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminRegisterRequest;

class AuthController extends Controller
{
    public function login(AdminLoginRequest $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Logged In successfully.',
            'token' => $admin->createToken('admin-auth-token', ['role:admin'])->plainTextToken
        ]);

    }

    public function register(AdminRegisterRequest $request)
    {
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registered successfully.'
        ], 200);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.'
        ], 200);
    }

    public function profile()
    {
        return response()->json([
            'success' => true,
            'message' => 'Admin profile.',
            'data' => Auth::user()
        ], 200);
    }
}
