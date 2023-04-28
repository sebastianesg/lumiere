<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user=auth()->user();
            $user->api_token = Str::random(60);
            $user->save();
            $token = auth()->user()->createToken('API Token')->accessToken;
            return response()->json(['token' => $token,"Authorization"=>$user->api_token], 200);
        }
        
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    
    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        
        return response()->json('Logged out successfully', 200);
    }
}
