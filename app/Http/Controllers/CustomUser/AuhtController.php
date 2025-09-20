<?php

namespace App\Http\Controllers\CustomUser;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CustomUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class AuhtController extends Controller
{
    protected $guard = 'custom'; // تحديد الـ guard المخصص

    /** Helper: رجّع locale الحالي من الراوت أو من التطبيق */
    protected function currentLocale(Request $request): string
    {
        return $request->route('locale') ?? app()->getLocale() ?? 'ar';
    }

    public function showRegistrationForm(Request $request)
    {
        return view('customauth.register');
    }

    public function register(Request $request)
    {
        $locale = $this->currentLocale($request);

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255|unique:customusers',
            'email'    => 'required|string|email|max:255|unique:customusers',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = CustomUser::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // أرسل رابط التفعيل (لا تسجل دخوله)
        try {
            $user->sendEmailVerificationNotification();
        } catch (\Throwable $e) {
            report($e);
        }

        // لعرض البريد في صفحة الإشعار بدون auth
        session()->flash('unverified_email', $user->email);

        return redirect()
            ->route('verification.notice.public', ['locale' => $locale])
            ->with('status', 'verification-link-sent');
    }

    public function showLoginForm(Request $request)
    {
        return view('customauth.login');
    }

    public function login(Request $request)
    {
        $locale = $this->currentLocale($request);

        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard($this->guard)->attempt($credentials, $request->boolean('remember'))) {
            /** @var \App\Models\CustomUser $user */
            $user = Auth::guard($this->guard)->user();

            if (!$user->hasVerifiedEmail()) {
                Auth::guard($this->guard)->logout();

                try {
                    $user->sendEmailVerificationNotification();
                } catch (\Throwable $e) {
                    report($e);
                }

                return back()
                    ->withErrors(['email' => __('auth.login_unverified')])
                    ->with('status', 'verification-link-sent')
                    ->withInput($request->only('email'));
            }

            RateLimiter::clear($this->throttleKey($request));

            return redirect()->intended(route('home', ['locale' => $locale]));
        }

        return back()
            ->withErrors(['email' => __('auth.login_invalid')])
            ->withInput();
    }

    public function logout(Request $request)
    {
        $locale = $this->currentLocale($request);

        Auth::guard($this->guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home', ['locale' => $locale]);
    }

    public function verifyEmailPublic(Request $request, $id, $hash)
    {
        $locale = $this->currentLocale($request);

        // تحقق من توقيع وصلاحية الرابط
        if (!URL::hasValidSignature($request)) {
            abort(403, __('auth.invalid_signature'));
        }

        $user = CustomUser::findOrFail($id);

        // مطابق لطريقة Laravel: sha1(email)
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, __('auth.wrong_verification_link'));
        }

        // لو كان البريد مفعّلاً مسبقاً
        if ($user->hasVerifiedEmail()) {
            Auth::guard($this->guard)->login($user); // اختياري
            return redirect()
                ->route('home', ['locale' => $locale])
                ->with('status', 'email-already-verified');
        }

        // وسم البريد كمفعّل + تسجيل الدخول (اختياري)
        $user->markEmailAsVerified();
        Auth::guard($this->guard)->login($user);

        return redirect()
            ->route('home', ['locale' => $locale])
            ->with('status', 'email-verified');
    }

    protected function throttleKey(Request $request): string
    {
        return strtolower(trim((string) $request->input('email'))) . '|' . $request->ip();
    }
}
