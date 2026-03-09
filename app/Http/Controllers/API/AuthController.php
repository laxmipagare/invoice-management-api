<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class AuthController extends Controller
{
    //
    
    public function register(Request $request)
    {
        $request->validate([
        'name'=>'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'role'=>'required'
        ]);

    
        $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'role'=>$request->role
        ]);

        return response()->json([
        'status'=>'success',
        'data'=>$user,
        'message'=>'User registered successfully'
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password,$user->password)){
        return response()->json(['message'=>'Invalid credentials'],401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
        'status'=>'success',
        'token'=>$token
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke the current token
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }
}
