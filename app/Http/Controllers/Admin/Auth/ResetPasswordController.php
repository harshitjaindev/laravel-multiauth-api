<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\AdminChangePasswordRequest;

class ResetPasswordController extends Controller
{
    public function changePassword(AdminChangePasswordRequest $request)
    {		
		$admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to find record.'
            ], 401);
        }
		
		/* $admin = Admin::update([
            'password' => Hash::make($request->password),
        ])->where('email', $request->email); */
		
		$admin = Admin::where('email', $request->email)
						->update(['password' => Hash::make($request->password)]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully.'
        ], 200);
    }
}
