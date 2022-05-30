<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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

        return view('dashboard.index');
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
