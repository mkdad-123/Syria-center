<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required','string','max:255', Rule::unique('customusers','name')],
            'email'    => ['required','string','email','max:255', Rule::unique('customusers','email')],
            'password' => ['required','string','min:8','confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'الاسم مطلوب.',
            'name.max'           => 'الاسم يجب ألا يتجاوز :max حرفًا.',
            'name.unique'        => 'هذا الاسم مستخدم بالفعل.',
            'email.required'     => 'البريد الإلكتروني مطلوب.',
            'email.email'        => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.max'          => 'البريد الإلكتروني يجب ألا يتجاوز :max حرفًا.',
            'email.unique'       => 'هذا البريد مستخدم بالفعل.',
            'password.required'  => 'كلمة المرور مطلوبة.',
            'password.min'       => 'كلمة المرور يجب ألا تقل عن :min أحرف.',
            'password.confirmed' => 'تأكيد كلمة المرور غير مطابق.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'     => 'الاسم',
            'email'    => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // لو الطلب Ajax/JSON بيرجع JSON 422، ولو Web form بيرجع redirect back تلقائيًا
        if ($this->expectsJson()) {
            $response = response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);

            throw new \Illuminate\Validation\ValidationException($validator, $response);
        }

        parent::failedValidation($validator);
    }
}
