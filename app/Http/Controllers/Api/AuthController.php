<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $field = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $field['email'])->first();

        if (!$user || !Hash::check($field['password'], $user->password)) {
            return response()->json([
                'status' => 401,
                'message' => 'Bad creds'
            ]);
        };

        $token = $user->createToken('myapptoken')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'status' => true,
            'message' => 'logged in Successfully',
            'data' => $data,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'message' => 'logged out Successfully',
        ]);
    }
}
