<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\returnSelf;

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


    public function changePassword(Request $request)
     {



        $request->validate([
             'old_password' => 'required|current_password', // current_password => check if the old password match the auth user password
             'new_password' => 'required|confirmed|regex:/^[a-zA-Z0-9!$#%]+$/',

        ]);


        // Update the new password
        $user = User::whereId(Auth::user()->id)->update([
              'password' => Hash::make($request->new_password)
        ]);




        // logout the current auth user
        Auth::user()->currentAccessToken()->delete();


        return response()->json([
             "message" => "password changed successful"
        ]);
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
