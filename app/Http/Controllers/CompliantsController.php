<?php

namespace App\Http\Controllers;

use App\Models\Compliants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompliantsController extends Controller
{
    public function addCompliants(Request $request) {
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
    
        // Get the authenticated user's ID or use the one from the form
        $userId = $request->id ?? null;
        
        // Create the complaint with current date
        $complaint = Compliants::create([
            'custom_user_id' => $userId,
            'content' => $request->content,
            'email' => $request->email,
            'date' => now()->toDateString(),
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'تم إرسال الشكوى بنجاح'
        ]);
    }

}
