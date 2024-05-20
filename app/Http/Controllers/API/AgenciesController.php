<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AgenciesIndex;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AgenciesController extends Controller
{
    // Route::post('addAgenciesIndex',[App\Http\Controllers\API\AgenciesController::class,'addAgenciesIndex']);
    
    // Route::post('editAgenciesIndex/{ageny_id}',[App\Http\Controllers\API\AgenciesController::class,'editAgenciesIndex']);

    // Route::delete('deleteAgenciesIndex/{ageny_id}',[App\Http\Controllers\API\AgenciesController::class,'deleteAgenciesIndex']);
    
    // Route::get('getAllAgenciesIndex',[App\Http\Controllers\API\AgenciesController::class,'getAllAgenciesIndex']);

    // Route::post('confirmAgenciesIndex/{ageny_id}',[App\Http\Controllers\API\AgenciesController::class,'confirmAgenciesIndex']);
    // Route::post('rejectAgenciesIndex/{ageny_id}',[App\Http\Controllers\API\AgenciesController::class,'rejectAgenciesIndex']);

    public function addAgenciesIndex(Request $request){
        $user = Auth::user();
        $client = User::find($request->user_id);
        if($request->file('image')){
            // Get the file path after storage
           $path = $request->file('image')->store('public/images');
       
           // Determine the base URL based on the environment
           if (app()->isLocal()) {
               // For local development
               $baseUrl = url('/');
           } else {
               // For production or any other environment
               $baseUrl = config('app.url');
           }
       
           // Concatenate the base URL with the file path
           $url = $baseUrl . Storage::url($path);
           //$url = request()->url() . Storage::url($path); // This line is incorrect, use the $baseUrl variable instead
           $base_url_replace = str_replace('/storage', '/storage/app/public', $url);
           //$base_url_replace = str_replace('/store/storage', '/storage', $url);
       }else{
           $path = "";
           $base_url_replace ="";
       }

        if($user){
            if($user->user_type == 'محامي'){
                AgenciesIndex::create([
                    'user_code' => $client->code,
                    'user_id' => $client->id,
                    'user_name' => $client->name,
                    'agencies_num_en' => $request->agencies_num_en,
                    'office_doc_en' => $request->office_doc_en,
                    'agencies_type_en' => $request->agencies_type_en,
                    'agencies_num_ar' => $request->agencies_num_ar,
                    'office_doc_ar' => $request->office_doc_ar,
                    'agencies_type_ar' => $request->agencies_type_ar,
                    'date' => $request->date,
                    'agencies_imagePath' => $path,
                    'agencies_imageUrl' => $base_url_replace,
                    'status' => 'confirmed'
                ]);
                return response()->json([
                    'message' => 'Agencies Index created successfully'
                ]);
            }else{
                AgenciesIndex::create([
                    'user_code' => $client->code,
                    'user_id' => $client->id,
                    'user_name' => $client->name,
                    'agencies_num_en' => $request->agencies_num_en,
                    'office_doc_en' => $request->office_doc_en,
                    'agencies_type_en' => $request->agencies_type_en,
                    'agencies_num_ar' => $request->agencies_num_ar,
                    'office_doc_ar' => $request->office_doc_ar,
                    'agencies_type_ar' => $request->agencies_type_ar,
                    'date' => $request->date,
                    'agencies_imagePath' => $path,
                    'agencies_imageUrl' => $base_url_replace,
                    'status' => 'pending'
                ]);
                return response()->json([
                    'message' => 'AgenciesIndex created successfully'
                ]);
            }
        }
        
    }

    public function editAgenciesIndex(Request $request,$ageny_id){
        $user = Auth::user();
        $client = User::find($request->user_id);
        $ageny = AgenciesIndex::find($ageny_id);
        
        if($request->file('image')){
            Storage::delete($ageny->agencies_imagePath);
            // Get the file path after storage
           $path = $request->file('image')->store('public/images');
       
           // Determine the base URL based on the environment
           if (app()->isLocal()) {
               // For local development
               $baseUrl = url('/');
           } else {
               // For production or any other environment
               $baseUrl = config('app.url');
           }
       
           // Concatenate the base URL with the file path
           $url = $baseUrl . Storage::url($path);
           //$url = request()->url() . Storage::url($path); // This line is incorrect, use the $baseUrl variable instead
           $base_url_replace = str_replace('/storage', '/storage/app/public', $url);
           //$base_url_replace = str_replace('/store/storage', '/storage', $url);
       }else{
           $path = $ageny->agencies_imagePath;
           $base_url_replace = $ageny->agencies_imageUrl;
       }
        if($user){
            if($user->user_type == 'محامي'){
                if($ageny->status != 'rejected'){
                    $ageny->update([
                        'user_code' => $client->code,
                        'user_id' => $client->id,
                        'user_name' => $client->name,
                        'agencies_num_en' => $request->agencies_num_en,
                        'office_doc_en' => $request->office_doc_en,
                        'agencies_type_en' => $request->agencies_type_en,
                        'agencies_num_ar' => $request->agencies_num_ar,
                        'office_doc_ar' => $request->office_doc_ar,
                        'agencies_type_ar' => $request->agencies_type_ar,
                        'date' => $request->date,
                        'agencies_imagePath' => $path,
                        'agencies_imageUrl' => $base_url_replace,  
                        
                    ]);
                    return response()->json([
                        'message' => 'AgenciesIndex updated successfully'
                    ]);
                }
                
            }else{
                if($ageny->status == 'pending'){
                    $ageny->update([
                        'user_code' => $client->code,
                        'user_id' => $client->id,
                        'user_name' => $client->name,
                        'agencies_num_en' => $request->agencies_num_en,
                        'office_doc_en' => $request->office_doc_en,
                        'agencies_type_en' => $request->agencies_type_en,
                        'agencies_num_ar' => $request->agencies_num_ar,
                        'office_doc_ar' => $request->office_doc_ar,
                        'agencies_type_ar' => $request->agencies_type_ar,
                        'date' => $request->date,
                        'agencies_imagePath' => $path,
                        'agencies_imageUrl' => $base_url_replace,
                            
                    ]);
                    return response()->json([
                        'message' => 'AgenciesIndex updated successfully'
                    ]);
                }
                
            }
        }
        
    }

    public function deleteAgenciesIndex($ageny_id){
        $user = Auth::user();
        $ageny = AgenciesIndex::find($ageny_id);
        Storage::delete($ageny->agencies_imagePath);
        if($user){
            if($user->user_type == 'محامي'){
                $ageny->delete();
                return response()->json([
                    'message' => 'AgenciesIndex deleted successfully'
                ]);
            }else{
                if($ageny->status == 'pending'){
                    $ageny->delete();
                    return response()->json([
                        'message' => 'AgenciesIndex deleted successfully'
                    ]);
                }
            }
        }
       
    }

    public function getAllAgenciesIndex(){
        $user = Auth::user();
        if($user){
            return response()->json([
                'AgenciesIndex' => AgenciesIndex::where('status','!=','rejected')->get()
            ]); 
        }
        
    }

    public function confirmAgenciesIndex($ageny_id){
        $user = Auth::user();
        $ageny = AgenciesIndex::find($ageny_id);
        if($user){
            if($user->user_type == 'محامي'){
                $ageny->update([
                    'status' => 'confirmed'
                   ]);
                   return response()->json([
                    'message' => 'AgenciesIndex confirmed successfully'
                   ]);
            }
        }
               
    }

    public function rejectAgenciesIndex($ageny_id){
        $user = Auth::user();
        $ageny = AgenciesIndex::find($ageny_id);
        if($user){
            if($user->user_type == 'محامي'){
                $ageny->update([
                    'status' => 'rejected'
                 ]);
                 return response()->json([
                  'message' => 'AgenciesIndex rejected successfully'
                 ]);
            }
        }
       
    }

    public function getAllAgenciesIndexByAgencyId($agency_id){
        $user = Auth::user();
        if($user){
            return response()->json([
                'AgencyIndex' => AgenciesIndex::find($agency_id)
            ]);
        }
    }
}
