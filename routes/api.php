<?php

//use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CollabController;
use App\Http\Controllers\API\ServicesController;
use App\Http\Controllers\API\BlogsController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    // Routes that require authentication
    Route::post('createNewUser',[App\Http\Controllers\API\AuthController::class,'createNewUser']);
    Route::get('userRoleRedirection',[App\Http\Controllers\API\AuthController::class,'userRoleRedirection']);
    Route::get('getAllusers',[App\Http\Controllers\API\UserController::class,'getAllusers']);
    Route::post('editUsers/{user_id}',[App\Http\Controllers\API\UserController::class,'editUsers']);
    Route::delete('deleteUser/{user_id}',[App\Http\Controllers\API\UserController::class,'deleteUser']);


    Route::get('getCaseFileForSpecificClient',[App\Http\Controllers\API\CaseController::class,'getCaseFileForSpecificClient']);



    Route::post('addCaseFile',[App\Http\Controllers\API\CaseController::class,'addCaseFile']);
    
    Route::post('editCaseFile/{case_id}',[App\Http\Controllers\API\CaseController::class,'editCaseFile']);

    Route::delete('deleteCaseFile/{case_id}',[App\Http\Controllers\API\CaseController::class,'deleteCaseFile']);
    
    Route::get('getAllCaseFile',[App\Http\Controllers\API\CaseController::class,'getAllCaseFile']);

    Route::post('confirmCaseFile/{case_id}',[App\Http\Controllers\API\CaseController::class,'confirmCaseFile']);
    Route::post('rejectCaseFile/{case_id}',[App\Http\Controllers\API\CaseController::class,'rejectCaseFile']);



    Route::post('addBailiffPaper',[App\Http\Controllers\API\BailiffController::class,'addBailiffPaper']);
    
    Route::post('editBailiffPaper/{bailiff_id}',[App\Http\Controllers\API\BailiffController::class,'editBailiffPaper']);

    Route::delete('deleteBailiffPaper/{bailiff_id}',[App\Http\Controllers\API\BailiffController::class,'deleteBailiffPaper']);
    
    Route::get('getAllBailiffPapers',[App\Http\Controllers\API\BailiffController::class,'getAllBailiffPapers']);

    Route::post('confirmBailiffPaper/{case_id}',[App\Http\Controllers\API\BailiffController::class,'confirmBailiffPaper']);
    Route::post('rejectBailiffPaper/{case_id}',[App\Http\Controllers\API\BailiffController::class,'rejectBailiffPaper']);


    Route::post('addAgenciesIndex',[App\Http\Controllers\API\AgenciesController::class,'addAgenciesIndex']);
    
    Route::post('editAgenciesIndex/{ageny_id}',[App\Http\Controllers\API\AgenciesController::class,'editAgenciesIndex']);

    Route::delete('deleteAgenciesIndex/{ageny_id}',[App\Http\Controllers\API\AgenciesController::class,'deleteAgenciesIndex']);
    
    Route::get('getAllAgenciesIndex',[App\Http\Controllers\API\AgenciesController::class,'getAllAgenciesIndex']);

    Route::post('confirmAgenciesIndex/{ageny_id}',[App\Http\Controllers\API\AgenciesController::class,'confirmAgenciesIndex']);
    Route::post('rejectAgenciesIndex/{ageny_id}',[App\Http\Controllers\API\AgenciesController::class,'rejectAgenciesIndex']);

});
Route::post('login',[App\Http\Controllers\API\AuthController::class,'login']);


Route::post('storeContactsMessages',[App\Http\Controllers\API\CaseController::class,'storeContactsMessages']);
   
Route::get('getAllContactsMessages',[App\Http\Controllers\API\CaseController::class,'getAllContactsMessages']);
//  Route::post('addCollab',[CollabController::class,'addCollab']);
 
//  Route::delete('deleteCollab/{collab_id}',[CollabController::class,'deleteCollab']);

//  Route::get('getAllCollab',[CollabController::class,'getAllCollab']);


//  Route::post('addService',[ServicesController::class,'addService']);

//  Route::post('updateService/{service_id}',[ServicesController::class,'updateService']);

//  Route::delete('deleteService/{service_id}',[ServicesController::class,'deleteService']);

//  Route::get('getAllServices',[ServicesController::class,'getAllServices']);


//  Route::post('addSubService/{service_id}',[ServicesController::class,'addSubService']);

//  Route::post('updateSubService/{sub_service_id}',[ServicesController::class,'updateSubService']);

//  Route::delete('deleteSubService/{sub_service_id}',[ServicesController::class,'deleteSubService']);

//  Route::get('getAllSubServices',[ServicesController::class,'getAllSubServices']);
 
//  Route::get('getAllSubServicesRelatedToService/{service_id}',[ServicesController::class,'getAllSubServicesRelatedToService']);



//  Route::post('addBlogs',[BlogsController::class,'addBlogs']);

//  Route::post('updateBlogs/{blog_id}',[BlogsController::class,'updateBlogs']);

//  Route::delete('deleteBlogs/{blog_id}',[BlogsController::class,'deleteBlogs']);

//  Route::get('getAllBlogs',[BlogsController::class,'getAllBlogs']);


//  Route::post('addBlogKeyword/{blog_id}',[BlogsController::class,'addBlogKeyword']);

//  Route::post('updateBlogKeyword/{blog_id}',[BlogsController::class,'updateBlogs']);

//  Route::delete('deleteBlogKeyword/{blog_id}',[BlogsController::class,'deleteBlogKeyword']);

//  Route::get('getAllBlogKeywordsRelatedToBlog/{blog_id}',[BlogsController::class,'getAllBlogKeywordsRelatedToBlog']);



// Route::post('addBlogSection/{blog_id}',[BlogsController::class,'addBlogSection']);

//  Route::post('updateBlogSection/{blogsect_id}',[BlogsController::class,'updateBlogSection']);

//  Route::delete('deleteBlogSection/{blogsect_id}',[BlogsController::class,'deleteBlogSection']);

//  Route::get('getAllBlogSectionsRelatedToBlog/{blog_id}',[BlogsController::class,'getAllBlogSectionsRelatedToBlog']);

 
 
// Route::post('addBlogSubSection/{section_id}',[BlogsController::class,'addBlogSubSection']);

//  Route::post('updateBlogSubSection/{blogsubsection_id}',[BlogsController::class,'updateBlogSubSection']);

//   Route::delete('deleteBlogSubSection/{blogsubsection_id}',[BlogsController::class,'deleteBlogSubSection']);

//  Route::get('getAllBlogSubSectionsRelatedToSection/{section_id}',[BlogsController::class,'getAllBlogSubSectionsRelatedToSection']);



// Route::get('getBlogData/{blog_id}',[BlogsController::class,'getBlogData']);












