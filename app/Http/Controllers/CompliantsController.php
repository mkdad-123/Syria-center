<?php

namespace App\Http\Controllers;

use App\Models\Compliants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompliantsController extends Controller
{
    public function addCompliants (Request $request) {
        // Validate the request data
    $validator = Validator::make($request->all(), [
        'content' => 'required|string|min:10',
        'email' => 'required|email|max:255',
    ]);

    // If validation fails, return errors
    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }

    // Create the complaint with current date
    $complaint = Compliants::create([
        'content' => $request->content,
        'email' => $request->email,
        'date' => now()->toDateString(), // Automatically set current date
    ]);
    return redirect()->route('compliants')->with('success', 'تم إرسال الشكوى بنجاح');
    }

}
