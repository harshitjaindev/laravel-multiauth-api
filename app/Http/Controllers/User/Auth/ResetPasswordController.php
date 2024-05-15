<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function forgotPassword(Request $request) {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['message' => __($status)])
                    : response()->json(['message' => __($status)], 400);
    }

    // public function resetPasswordForm(Request $request, $token = null) {
    //     echo 123;die;
    //     return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    // }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                //event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? response()->json(['message' => __($status)])
                    : response()->json(['message' => __($status)], 400);
    }
}
