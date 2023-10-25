<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{




    public function register(Request $request)
    {

        Gate::authorize('register');
        $request->validate([
            "name" => "required|min:3",
            "photo" => "nullable",
            "email" => "required|email|unique:users",
            "password" => "required|min:8",
            "phone_number" => "required|min:9|max:15|unique:users",
            "address" => "nullable",
            "gender" => "required|in:male,female",
            "dob" => "nullable",
            "role" => "in:admin,staff"
        ]);

        $user = User::create([
            "name" => $request->name,
            "photo" => $request->photo,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "gender" => $request->gender,
            "dob" => $request->dob,
            "role" => 'staff',
        ]);

        return $user;
    }


    public function updateRole(Request $request,string $id)
    {
        Gate::authorize('register');


          $user = User::find($id);

          if(is_null($user)) {
            abort(404, 'user not found');

          }else {
             $user->role = $request->role;
             $user->save();

          }


          return response()->json([
             'message' =>  'updated role for this user'
          ]);

    }


    public function ban(string $id)

    {

        Gate::authorize('register');

        $user = User::find($id);


         if(is_null($user)) {
            abort(404, 'user not found');
         }

         if($user->role != "ban") {

            // first => log out of this user
            foreach ($user->tokens as $token) {
                $token->delete();
            }

            $user->role = 'ban';
            $user->save();

            return response()->json([
                'message' => 'User has been banned successfully'
            ]);
         }else {
            return response()->json([
                'message' => 'User has been banned already'
            ]);
        }

    }
}
