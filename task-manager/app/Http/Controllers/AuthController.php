<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $fields = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);


        if ($fields->fails()) {
            return response()->json([
                'status' => 422,
                "errors" => $fields->messages()
            ]);
        } else {

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            $token = $user->createToken('myAppToken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token,
                'status' => 201,
            ];

            return response($response);
        }
    }


    public function login(Request $request)
    {
        $fields =  Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($fields->fails()) {
            return response()->json([
                'status' => 422,
                "errors" => $fields->messages()
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => "User not Found",
                "status" => 401
            ]);
        }

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user->name,
            'token' => $token,
            "status" => 200
        ];
        return response($response);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return $response = [
            'message' => 'Logged Out',
            'status' => 200
        ];
        return $response;
    }
}
