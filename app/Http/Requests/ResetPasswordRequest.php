<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => 'required|email|exists:customusers,email',
            'token'    => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'البريد الإلكتروني مطلوب.',
            'email.email'       => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.exists'      => 'لا يوجد مستخدم بهذا البريد.',
            'token.required'    => 'رمز التحقق (التوكن) مطلوب.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min'      => 'كلمة المرور يجب ألا تقل عن :min أحرف.',
            'password.confirmed'=> 'تأكيد كلمة المرور غير مطابق.',
        ];
    }

    public function attributes(): array
    {
        return [
            'email'    => 'البريد الإلكتروني',
            'token'    => 'رمز التحقق',
            'password' => 'كلمة المرور',
        ];
    }

    // ضبط شكل الاستجابة للأخطاء (API JSON 422)
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'status'  => 'error',
            'message' => 'Validation failed',
            'errors'  => $validator->errors(),
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
