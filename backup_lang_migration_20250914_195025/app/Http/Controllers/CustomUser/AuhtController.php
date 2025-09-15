<?php

namespace App\Http\Controllers\CustomUser;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CustomUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;

class AuhtController extends Controller
{
    protected $guard = 'custom'; // تحديد الـ guard المخصص

    public function showRegistrationForm()
    {
        return view('customauth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:customusers',
            'email' => 'required|string|email|max:255|unique:customusers',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = CustomUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::guard($this->guard)->login($user);

        return redirect('/')->with('success', 'تم التسجيل بنجاح!');
    }

    public function showLoginForm()
    {
        return view('customauth.login');
    }

 public function login(Request $request)
{
    // التحقق من صحة البيانات
    $request->validate([
        'name' => 'required|string',
        'password' => 'required|string',
    ]);

    // استخراج بيانات الاعتماد
    $credentials = $request->only('name', 'password');
    $remember = $request->filled('remember');

    // تسجيل محاولة الدخول في السجل
    RateLimiter::hit('login:'.$request->ip());

    // استخدام Guard المخصص للـ customusers
    if (Auth::guard($this->guard)->attempt($credentials, $remember)) {
        $request->session()->regenerate();

        // مسح عداد المحاولات الفاشلة عند النجاح
        RateLimiter::clear('login:'.$request->ip());

        return redirect()->intended('/');
    }

    // في حالة فشل المصادقة
    return back()->withErrors([
        'name' => trans('auth.failed'),
    ])->withInput($request->only('name', 'remember'));
}
    public function logout(Request $request)
    {
        Auth::guard($this->guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
