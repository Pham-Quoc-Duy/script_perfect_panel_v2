<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

/**
 * ResetPasswordController - Xử lý reset mật khẩu
 * 
 * Hiển thị giao diện reset mật khẩu và xử lý reset
 */
class ResetPasswordController extends Controller
{
    /**
     * Display reset password form
     */
    public function show(Request $request): View
    {
        return view('clients.auth.reset-password', [
            'request' => $request,
        ]);
    }

    /**
     * Handle reset password request
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Reset password
        $status = Password::reset(
            $validated,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password reset successfully. Please login with your new password.');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
