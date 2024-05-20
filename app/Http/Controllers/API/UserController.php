<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAllusers(){
        $user = Auth::user();
        if($user && $user->user_type == 'محامي'){
            return response()->json([
                'users' => User::all()
            ]);
        }
    }

    public function editUsers(Request $request,$user_id){
        $user = Auth::user();
        if($user && $user->user_type == 'محامي'){
            $user = User::find($user_id);
            $user->update([
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
                'message' => 'user updated successfully'
            ]); 
        }
    }

    public function deleteUser($user_id){
        $user = Auth::user();
        if($user && $user->user_type == 'محامي'){
            User::find($user_id)->delete();
            return response()->json([
                'message' => 'user deleted successfully'
            ]); 
        }
        
    }

    public function getUserById($user_id){
        $user = User::find($user_id);
        $Admin = Auth::user();
        if($Admin && $Admin->user_type == 'محامي'){
            return response()->json([
                'user' => $user
            ]); 
        }
    }
}
