<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {


        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            abort(401, 'user name or password wrong');
        }


        return Auth::user()->createToken($request->device ?? 'unknown')->plainTextToken;
    }



    public function logout() {
          Auth::user()->currentAccessToken()->delete();

          return response()->json([
             'message' => 'logout successful',
          ]);
    }

    public function accessToken() {

        return Auth::user()->tokens;

    }
}
