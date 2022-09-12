<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $field = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $field['email'])->first();
        if(!$user){
            return response()->json([
                'status' => 404,
                'errors' => [
                    'email' => [
                        'User is not exist'
                    ]
                ]
            ],404);
        }

        if (!Hash::check($field['password'], $user->password)) {
            return response()->json([
                'status' => 401,
                'errors' => [
                    'password' => [
                        'Wrong password'
                    ]
                ]
            ],401);
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

    public function signup(Request $request){
        $field = $request->validate([
            'username' => ['required', Rule::unique('users')->whereNull('deleted_at')],
            'email' => ['required', Rule::unique('users')->whereNull('deleted_at')],
            'password' => 'required|string',
        ]);
        // $user = new User();
        // $user->type = 5;
        // $user->username = $request->username?$request->username : "anyone";
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user = User::create([
            'type' => 5,
        'username' => $request->username?$request->username : "anyone",
        'email' => $request->email,
        'password' => Hash::make($request->password)
        ]);
        // $user = User::create(request([ 'type', 'username','email', 'password']));
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

    
    public function remove_account(Request $request)
    {
        $user = User::find($request->user_id);
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'Account deleted Successfully',
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
