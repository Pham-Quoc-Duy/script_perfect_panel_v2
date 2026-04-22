<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Password;

/**
 * ForgotPasswordController - Xử lý quên mật khẩu
 * 
 * Hiển thị giao diện quên mật khẩu và gửi link reset
 */
class ForgotPasswordController extends Controller
{
    /**
     * Display forgot password form
     */
    public function show(): View
    {
        return view('clients.auth.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Send password reset link
        $status = Password::sendResetLink(
            $validated
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Password reset link sent to your email.');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
