<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showInstall()
    {
        return view('clients.install');
    }

    public function showLogin()
    {
        // Get theme from config or use default
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';
        return view("clients.theme-{$theme}.auth.signin");
    }

    public function showForgotPassword()
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';
        return view("clients.theme-{$theme}.auth.forgot-password", compact('config'));
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(
            ['email' => 'required|email'],
            ['email.required' => 'Vui lòng nhập email', 'email.email' => 'Email không hợp lệ']
        );

        // Luôn trả về thông báo thành công để tránh lộ thông tin tài khoản
        return back()->with('status', 'Nếu email tồn tại trong hệ thống, chúng tôi đã gửi link đặt lại mật khẩu.');
    }

    public function showRegister()
    {
        // Get theme from config or use default
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';
        return view("clients.theme-{$theme}.auth.signup");
    }

    public function install(Request $request)
    {
        // Simplified install process - no complex domain checking
        $rules = [
            'name' => 'required|string|max:255|min:2',
            'username' => 'required|string|max:255|unique:users|regex:/^[a-z0-9_]{3,}$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];

        $data = $request->validate($rules, [
            'name.required' => 'Vui lòng nhập họ và tên',
            'name.min' => 'Họ và tên phải có ít nhất 2 ký tự',
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập này đã tồn tại',
            'username.regex' => 'Tên đăng nhập chỉ chứa chữ thường, số và gạch dưới (tối thiểu 3 ký tự)',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã được đăng ký',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
        ]);

        try {
            DB::transaction(function () use ($data, $request) {
                // Create admin user
                $admin = User::create([
                    'name' => trim($data['name']),
                    'username' => strtolower(trim($data['username'])),
                    'email' => strtolower(trim($data['email'])),
                    'password' => Hash::make($data['password']),
                    'api_key' => Str::random(32),
                    'referral_code' => Str::random(8),
                    'role' => 'admin',
                    'level' => 'distributor',
                    'timezone' => 14400,
                    'lang' => 'en',
                    'currency' => 'USD',
                    'is_active' => true,
                    'balance' => 0.0,
                    'spent' => 0.0,
                    'domain' => getDomain(),
                ]);

                // Create basic config
                Config::create([
                    'user_id' => $admin->id,
                    'title' => 'SMM Panel',
                    'description' => 'Hệ thống quản lý dịch vụ mạng xã hội',
                    'timezone' => 14400,
                    'domain' => getDomain(),
                    'domain_main' => getDomain(),
                    'default_currency' => 'USD',
                    'default_lang' => 'en',
                    'default_interface' => 'default',
                    'status' => true,
                ]);
            });

            return redirect()->route('login');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Vui lòng thử lại hoặc kiểm tra lại ' . $e->getMessage())
                ->withInput();
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:6',
        ], [
            'username.required' => 'Vui lòng nhập tên đăng nhập hoặc email',
            'username.min' => 'Tên đăng nhập phải có ít nhất 3 ký tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);

        try {
            // Find user by username or email
            $user = User::where(function ($query) use ($request) {
                $query
                    ->where('username', $request->username)
                    ->orWhere('email', $request->username);
            })->first();

            if (!$user) {
                return back()
                    ->with('error', 'Tài khoản không tồn tại')
                    ->withInput();
            }

            if (!$user->is_active) {
                return back()
                    ->with('error', 'Tài khoản của bạn đã bị khóa')
                    ->withInput();
            }

            if (!Hash::check($request->password, $user->password)) {
                return back()
                    ->with('error', 'Tài khoản hoặc mật khẩu không đúng')
                    ->withInput();
            }

            Auth::login($user, $request->has('remember'));

            // Log login activity
            $this->logLoginActivity($request, $user);

            return redirect()
                ->intended(route('clients.new'))
                ->with('success', 'Đăng nhập thành công!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Có lỗi xảy ra khi đăng nhập: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function logLoginActivity(Request $request, User $user)
    {
        try {
            \App\Models\ActivityLog::create([
                'user_id' => $user->id,
                'type' => 'login',
                'activity' => json_encode([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]),
                'domain' => $request->getHost(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Login activity log failed: ' . $e->getMessage());
        }
    }

    public function loginGoogle(Request $request)
    {
        $request->validate(['id_token' => 'required|string']);

        try {
            $config = Config::where('domain', getDomain())->first();

            if (!$config || !$config->google_oauth_status || !$config->google_oauth_client_id) {
                return response()->json(['success' => false, 'message' => 'Google OAuth chưa được kích hoạt.'], 403);
            }

            // Verify id_token với Google
            $ch = curl_init('https://oauth2.googleapis.com/tokeninfo?id_token=' . $request->id_token);
            curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false]);
            $payload = json_decode(curl_exec($ch), true);
            curl_close($ch);

            if (!$payload || isset($payload['error']) || ($payload['aud'] ?? '') !== $config->google_oauth_client_id) {
                return response()->json(['success' => false, 'message' => 'Token Google không hợp lệ.'], 401);
            }

            $email = $payload['email'] ?? null;
            if (!$email) {
                return response()->json(['success' => false, 'message' => 'Không lấy được email từ Google.'], 400);
            }

            // Tìm hoặc tạo user
            $user = User::where('email', $email)->where('domain', getDomain())->first();

            if (!$user) {
                $base = Str::slug($payload['given_name'] ?? explode('@', $email)[0], '');
                $username = $base;
                $i = 1;
                while (User::where('username', $username)->where('domain', getDomain())->exists()) {
                    $username = $base . $i++;
                }

                $user = User::create([
                    'name'          => $payload['name'] ?? $email,
                    'username'      => $username,
                    'email'         => $email,
                    'password'      => Hash::make(Str::random(32)),
                    'api_key'       => Str::random(32),
                    'referral_code' => Str::random(8),
                    'role'          => 'member',
                    'level'         => 'retail',
                    'lang'          => $config->default_lang ?? 'en',
                    'currency'      => $config->default_currency ?? 'USD',
                    'timezone'      => $config->timezone ?? 0,
                    'balance'       => 0.0,
                    'spent'         => 0.0,
                    'is_active'     => true,
                    'domain'        => getDomain(),
                ]);
            }

            if (!$user->is_active) {
                return response()->json(['success' => false, 'message' => 'Tài khoản đã bị khóa.'], 403);
            }

            Auth::login($user, true);

            return response()->json([
                'success'  => true,
                'message'  => 'Đăng nhập thành công',
                'redirect' => route('clients.new'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users|regex:/^[a-z0-9_]{3,}$/',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
            'agree_terms' => 'required|accepted',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên',
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập này đã tồn tại',
            'username.regex' => 'Tên đăng nhập chỉ chứa chữ thường, số và gạch dưới (tối thiểu 3 ký tự)',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã được đăng ký',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'agree_terms.required' => 'Vui lòng đồng ý với điều khoản sử dụng',
        ]);

        try {
            // Get default language from config
            $cf = Config::where('domain',getDomain())->first();

            $user = User::create([
                'name' => trim($request->name),
                'username' => strtolower(trim($request->username)),
                'email' => strtolower(trim($request->email)),
                'password' => Hash::make($request->password),
                'api_key' => Str::random(32),
                'referral_code' => Str::random(8),
                'role' => 'member',
                'level' => 'retail',
                'lang' => $cf->default_lang ?? 'en',
                'currency' => $cf->default_currency ?? 'USD',
                'timezone' => $cf->timezone ?? 0,
                'balance' => 0.0,
                'spent' => 0.0,
                'is_active' => true,
                'domain' => getDomain(),
            ]);

            Auth::login($user, true);

            return redirect()
                ->route('clients.new')
                ->with('success', 'Tạo tài khoản thành công!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Có lỗi xảy ra khi tạo tài khoản: ' . $e->getMessage())
                ->withInput();
        }
    }
}
