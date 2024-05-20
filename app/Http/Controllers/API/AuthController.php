<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function createNewUser(Request $request){
        $user = Auth::user();
        if($user && $user->user_type == 'محامي'){
            if($request->password == $request->confirm_password){
                // $request->validate([
                //     'code' => 'required|string|max:255|unique:users',
                //     'password' => 'required|string|confirmed',
                // ]);
                User::create([
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'code' => $request->code,
                    'phone_number' => $request->phone_number,
                    'personal_id' => $request->personal_id,
                    'address' => $request->address,
                    'gender' => $request->gender,
                    'user_type' => $request->user_type,
                    'litigationDegree_en' => $request->litigationDegree_en,
                    'litigationDegree_ar' => $request->litigationDegree_ar
                ]); 
                return response()->json([
                    'message' => 'New user created successfully'
                ]); 
            }else{
                return response()->json([
                    'message' => 'password is not matched with confirm password'
                ],401);
            }
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('code', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
               'message' => 'You logged in successfully',
                'token' => $user->createToken('API Token')->plainTextToken,
                'user' => $user,
                'user_type' => $user->user_type
            ]);
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
   
    }

    public function userRoleRedirection(){
        $user = Auth::user();
            return response()->json([
                'user_type' => $user->user_type
            ]);
    }
}
