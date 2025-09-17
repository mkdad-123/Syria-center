<?php

namespace App\Http\Controllers\CustomUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PasswordResetCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use App\Mail\ResetPasswordMail;
use App\Models\CustomUser;
use App\Models\ResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    protected $guard = 'custom'; // تحديد الـ guard المخصص

    public function sendResetCode(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customusers,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // حذف الأكواد القديمة لنفس البريد
        ResetPassword::where('email', $request->email)->delete();

        $code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(30);

        ResetPassword::create([
            'email' => $request->email,
            'code' => $code,
            'expires_at' => $expiresAt
        ]);

        Mail::to($request->email)->send(new ResetPasswordMail($code));

        if ($request->ajax() || $request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => __('auth.success_code_sent'),
                'email'   => $request->email,
            ]);
        }

        // طلب عادي -> وجّه لصفحة التحقق مع تمرير الإيميل
        return redirect()
            ->route('password.verify', ['locale' => app()->getLocale(), 'email' => $request->email])
            ->with('status', __('auth.success_code_sent'));
    }


    public function verifyResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customusers,email',
            'code' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $resetCode = ResetPassword::where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$resetCode) {
            return response()->json([
                'status' => 'error',
                'message' => 'رمز التحقق غير صحيح'
            ], 400);
        }

        if (Carbon::now()->gt($resetCode->expires_at)) {
            return response()->json([
                'status' => 'error',
                'message' => 'رمز التحقق منتهي الصلاحية'
            ], 400);
        }

        // إنشاء وتخزين توكن إعادة التعيين
        $token = Str::random(60);
        $resetCode->update([
            'reset_token' => $token,
            'expires_at' => Carbon::now()->addMinutes(30) // تجديد صلاحية التوكن
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تم التحقق من الرمز بنجاح',
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customusers,email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $resetCode = ResetPassword::where('email', $request->email)
            ->where('reset_token', $request->token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$resetCode) {
            return response()->json([
                'status' => 'error',
                'message' => 'توكن إعادة التعيين غير صحيح أو منتهي الصلاحية'
            ], 400);
        }

        $user = CustomUser::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // حذف السجل بعد الاستخدام
        $resetCode->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم إعادة تعيين كلمة المرور بنجاح'
        ]);
    }
}
