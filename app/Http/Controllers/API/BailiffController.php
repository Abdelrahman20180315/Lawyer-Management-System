<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BailiffsPapers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BailiffController extends Controller
{
    public function addBailiffPaper(Request $request){
        $user = Auth::user();
        $client = User::find($request->user_id);
        if($user){
            if($user->user_type == 'محامي'){
                BailiffsPapers::create([
                    'bailiffs_pen_en' => $request->bailiffs_pen_en,
                    'bailiffs_pen_ar' => $request->bailiffs_pen_ar,
                    'user_code' => $client->code,
                    'user_id' => $client->id,
                    'user_name' => $client->name,
                    'Delivery time' => $request->Delivery_time,
                    'session_time' => $request->session_time,
                    'bailiffs_num' => $request->bailiffs_num,
                    'status' => 'confirmed',
                ]);
                return response()->json([
                    'message' => 'Bailiffs Papers created successfully'
                ]);
            }else{
                BailiffsPapers::create([
                    'bailiffs_pen_en' => $request->bailiffs_pen_en,
                    'bailiffs_pen_ar' => $request->bailiffs_pen_ar,
                    'user_code' => $client->code,
                    'user_id' => $client->id,
                    'user_name' => $client->name,
                    'Delivery time' => $request->Delivery_time,
                    'session_time' => $request->session_time,
                    'bailiffs_num' => $request->bailiffs_num,
                    'status' => 'pending'
                ]);
                return response()->json([
                    'message' => 'Bailiffs Papers created successfully'
                ]);
            }
        }
        
    }

    public function editBailiffPaper(Request $request,$bailiff_id){
        $user = Auth::user();
        $client = User::find($request->user_id);
        $bailiff = BailiffsPapers::find($bailiff_id);
        if($user){
            if($user->user_type == 'محامي'){
                if($bailiff->status != 'rejected'){
                    $bailiff->update([
                    'bailiffs_pen_en' => $request->bailiffs_pen_en,
                    'bailiffs_pen_ar' => $request->bailiffs_pen_ar,
                    'user_code' => $client->code,
                    'user_id' => $client->id,
                    'user_name' => $client->name,
                    'Delivery time' => $request->Delivery_time,
                    'session_time' => $request->session_time,
                    'bailiffs_num' => $request->bailiffs_num,
                        
                    ]);
                    return response()->json([
                        'message' => 'Bailiffs Papers updated successfully'
                    ]);
                }
                
            }else{
                if($bailiff->status == 'pending'){
                    $bailiff->update([
                        'bailiffs_pen_en' => $request->bailiffs_pen_en,
                        'bailiffs_pen_ar' => $request->bailiffs_pen_ar,
                        'user_code' => $client->code,
                        'user_id' => $client->id,
                        'user_name' => $client->name,
                        'Delivery time' => $request->Delivery_time,
                        'session_time' => $request->session_time,
                        'bailiffs_num' => $request->bailiffs_num,
                            
                    ]);
                    return response()->json([
                        'message' => 'Bailiffs Papers updated successfully'
                    ]);
                }
                
            }
        }
        
    }

    public function deleteBailiffPaper($bailiff_id){
        $user = Auth::user();
        $bailiff = BailiffsPapers::find($bailiff_id);
        if($user){
            if($user->user_type == 'محامي'){
                $bailiff->delete();
                return response()->json([
                    'message' => 'Case File deleted successfully'
                ]);
            }else{
                if($bailiff->status == 'pending'){
                    $bailiff->delete();
                    return response()->json([
                        'message' => 'Case File deleted successfully'
                    ]);
                }
            }
        }
       
    }

    public function getAllBailiffPapers(){
        $user = Auth::user();
        if($user){
            return response()->json([
                'BailiffsPapers' => BailiffsPapers::where('status','!=','rejected')->get()
            ]); 
        }
        
    }

    public function confirmBailiffPaper($bailiff_id){
        $user = Auth::user();
        $bailiff = BailiffsPapers::find($bailiff_id);
        if($user){
            if($user->user_type == 'محامي'){
                $bailiff->update([
                    'status' => 'confirmed'
                   ]);
                   return response()->json([
                    'message' => 'BailiffsPapers confirmed successfully'
                   ]);
            }
        }
               
    }

    public function rejectBailiffPaper($bailiff_id){
        $user = Auth::user();
        $bailiff = BailiffsPapers::find($bailiff_id);
        if($user){
            if($user->user_type == 'محامي'){
                $bailiff->update([
                    'status' => 'rejected'
                 ]);
                 return response()->json([
                  'message' => 'BailiffsPapers rejected successfully'
                 ]);
            }
        }
       
    }

    public function getBailifPaperByBailifId($bailiff_id){
        $user = Auth::user();
        if($user){
            return response()->json([
                'BailifPaper' => BailiffsPapers::find($bailiff_id)
            ]);
        }
    }
}
