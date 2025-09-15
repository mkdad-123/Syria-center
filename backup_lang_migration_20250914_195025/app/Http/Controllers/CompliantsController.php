<?php

namespace App\Http\Controllers;

use App\Models\Compliants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompliantsController extends Controller
{
    public function addCompliants(Request $request) {
        $validated = $request->validate([
            'content' => 'required|string|min:10',
            'email' => 'required|email|max:255',
        ]);

        $data = [
            'content' => $validated['content'],
            'email' => $validated['email'],
            'date' => now()->toDateString(),
        ];

        // أضف custom_user_id فقط إذا كان المستخدم معرّفاً
        if (Auth::guard('custom')->check()) {
            $data['custom_user_id'] = Auth::guard('custom')->id();
        }

        $complaint = Compliants::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إرسال الشكوى بنجاح'
        ]);
    }
}
