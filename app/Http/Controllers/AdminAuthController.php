<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Hash;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $admin->createToken('admin_token')->plainTextToken;

        // Role bilgisini session'a kaydet
        session(['role' => 'admin']);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => 'admin',
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
}
