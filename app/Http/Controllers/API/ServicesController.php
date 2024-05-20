<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    
//  Route::post('addService',[ServicesController::class,'addService']);

//  Route::put('updateService/{service_id}',[ServicesController::class,'updateService']);

//  Route::delete('deleteService/{service_id}',[ServicesController::class,'deleteService']);

//  Route::post('addSubService',[ServicesController::class,'addSubService']);

//  Route::put('updateSubService/{sub_service_id}',[ServicesController::class,'updateSubService']);

//  Route::delete('deleteSubService/{service_id}',[ServicesController::class,'deleteSubService']);

    public function addService(Request $request){
        
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
        
       
        Service::create([
            'title_en' => $request->title_en,
            'image_path' => $path,
            'image_url' => $base_url_replace,
            'description_en' => $request->description_en,
            'title_ar' => $request->title_ar ,
            'description_ar' => $request->description_ar
        ]);
        return response()->json([
            'message' => 'service added successfully',
            'image_url' => $base_url_replace
        ]);
    }

   public function updateService($service_id, Request $request){
    $service = Service::find($service_id);
    
    
    if($request->file('image')){
        $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg', // Adjust max file size as necessary
    ]);
            Storage::delete($service->image_path);
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
            $path = $service->image_path;
            $base_url_replace = $service->image_url;
    }

    

    $service->update([
        'title_en' => $request->title_en,
        'image_path' => $path,
        'image_url' => $base_url_replace,
        'description_en' => $request->description_en,
        'title_ar' => $request->title_ar,
        'description_ar' => $request->description_ar
    ]);

    return response()->json([
        'message' => 'service updated successfully',
        'image_url' => $base_url_replace
    ]);
}

    public function deleteService($service_id , Request $request){
        $service = Service::find($service_id);
        Storage::delete($service->image_path);
        $service->delete();
        return response()->json([ 
            'message' => 'service deleted successfully'
        ]);
    }  
    
    public function getAllServices(){
        return response()->json([
            'services' => Service::all()
        ]);
    }
    
    public function addSubService(Request $request , $service_id){
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg', // Adjust max file size as necessary
        ]);
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
           $base_url_replace = "";
        }
        
        SubServices::create([
            'title_en' => $request->title_en,
            'image_path' => $path,
            'image_url' => $base_url_replace,
            'description_en' => $request->description_en,
            'title_ar' => $request->title_ar ,
            'description_ar' => $request->description_ar,
            'service_id' => $service_id
        ]);
        return response()->json([
            'message' => 'subService added successfully',
            'image_url' => $base_url_replace
        ]);
    }

    public function updateSubService($sub_service_id , Request $request){
        $sub_service = SubServices::find($sub_service_id);
        
        if($request->file('image')){
            $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg', // Adjust max file size as necessary
        ]);
            Storage::delete($sub_service->image_path);
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
            $path = $sub_service->image_path;
           $base_url_replace = $sub_service->image_url;
        }
        
        $sub_service->update([
            'title_en' => $request->title_en,
            'image_path' => $path,
            'image_url' => $base_url_replace,
            'description_en' => $request->description_en,
            'title_ar' => $request->title_ar ,
            'description_ar' => $request->description_ar,
            'service_id' => $sub_service->service_id
        ]);
        return response()->json([
            'message' => 'subService updated successfully',
            'image_url' => $base_url_replace
        ]);
    }
    public function deleteSubService($sub_service_id , Request $request){
        $sub_service = SubServices::find($sub_service_id);
        Storage::delete($sub_service->image_path);
        $sub_service->delete();
        return response()->json([
            'message' => 'subService deleted successfully'
        ]);
    } 
    public function getAllSubServices(){
        return response()->json([
            'SubServices' => SubServices::all()
        ]);
    }
    
    public function getAllSubServicesRelatedToService($service_id){
        $subservices = SubServices::where('service_id' , $service_id)->get();
        return response()->json([
            'subservices' => $subservices
        ]);
    }
 }
