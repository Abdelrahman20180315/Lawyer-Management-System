<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CaseFile;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{
    public function addCaseFile(Request $request){
        $user = Auth::user();
        $client = User::find($request->user_id);
        if($user){
            if($user->user_type == 'محامي'){
                CaseFile::create([
                    'court_en' => $request->court_en,
                    'user_id' => $client->id,
                    'user_name' => $client->name,
                    'user_code' => $client->code,
                    'user_status_en' => $request->user_status_en,
                    'enemy_status_en' => $request->enemy_status_en,
                    'last_session_en' => $request->last_session_en,
                    'decision_en' => $request->decision_en,
                    'court_ar' => $request->court_ar,
                    'user_status_ar' => $request->user_status_ar,
                    'enemy_status_ar' => $request->enemy_status_ar,
                    'last_session_ar' => $request->last_session_ar,
                    'decision_ar' => $request->decision_ar,
                    'status' => 'confirmed',
                ]);
                return response()->json([
                    'message' => 'Case File created successfully'
                ]);
            }else{
                CaseFile::create([
                    'court_en' => $request->court_en,
                    'user_id' => $client->id,
                    'user_name' => $client->name,
                    'user_code' => $client->code,
                    'user_status_en' => $request->user_status_en,
                    'enemy_status_en' => $request->enemy_status_en,
                    'last_session_en' => $request->last_session_en,
                    'decision_en' => $request->decision_en,
                    'court_ar' => $request->court_ar,
                    'user_status_ar' => $request->user_status_ar,
                    'enemy_status_ar' => $request->enemy_status_ar,
                    'last_session_ar' => $request->last_session_ar,
                    'decision_ar' => $request->decision_ar,
                    'status' => 'pending',
                ]);
                return response()->json([
                    'message' => 'Case File created successfully'
                ]);
            }
        }
        
    }

    public function editCaseFile(Request $request,$case_id){
        $user = Auth::user();
        $client = User::find($request->user_id);
        $case = CaseFile::find($case_id);
        if($user){
            if($user->user_type == 'محامي'){
                if($case->status != 'rejected'){
                    $case->update([
                        'court_en' => $request->court_en,
                        'user_id' => $client->id,
                        'user_name' => $client->name,
                        'user_code' => $client->code,
                        'user_status_en' => $request->user_status_en,
                        'enemy_status_en' => $request->enemy_status_en,
                        'last_session_en' => $request->last_session_en,
                        'decision_en' => $request->decision_en,
                        'court_ar' => $request->court_ar,
                        'user_status_ar' => $request->user_status_ar,
                        'enemy_status_ar' => $request->enemy_status_ar,
                        'last_session_ar' => $request->last_session_ar,
                        'decision_ar' => $request->decision_ar,
                        
                    ]);
                    return response()->json([
                        'message' => 'Case File updated successfully'
                    ]);
                }
                
            }else{
                if($case->status == 'pending'){
                    $case->update([
                        'court_en' => $request->court_en,
                        'user_id' => $client->id,
                        'user_name' => $client->name,
                        'user_code' => $client->code,
                        'user_status_en' => $request->user_status_en,
                        'enemy_status_en' => $request->enemy_status_en,
                        'last_session_en' => $request->last_session_en,
                        'decision_en' => $request->decision_en,
                        'court_ar' => $request->court_ar,
                        'user_status_ar' => $request->user_status_ar,
                        'enemy_status_ar' => $request->enemy_status_ar,
                        'last_session_ar' => $request->last_session_ar,
                        'decision_ar' => $request->decision_ar,
                    ]);
                    return response()->json([
                        'message' => 'Case File updated successfully'
                    ]);
                }
                
            }
        }
        
    }

    public function deleteCaseFile($case_id){
        $user = Auth::user();
        $case = CaseFile::find($case_id);
        if($user){
            if($user->user_type == 'محامي'){
                $case->delete();
                return response()->json([
                    'message' => 'Case File deleted successfully'
                ]);
            }else{
                if($case->status == 'pending'){
                    $case->delete();
                    return response()->json([
                        'message' => 'Case File deleted successfully'
                    ]);
                }
            }
        }
       
    }

    public function getAllCaseFile(){
        $user = Auth::user();
        if($user){
            return response()->json([
                'cases' => CaseFile::where('status','!=','rejected')->get()
            ]); 
        }
        
    }

    public function getCaseFileForSpecificClient(){
        return response()->json([
            'cases' => CaseFile::where('user_id',Auth::id())->get()
        ]);
    }

    public function confirmCaseFile($case_id){
        $user = Auth::user();
        $case = CaseFile::find($case_id);
        if($user){
            if($user->user_type == 'محامي'){
                $case->update([
                 'status' => 'confirmed'
                ]);
                return response()->json([
                 'message' => 'Case File confirmed successfully'
                ]);
            }
        }
       
    }

    public function rejectCaseFile($case_id){
        $user = Auth::user();
        $case = CaseFile::find($case_id);
        if($user){
            if($user->user_type == 'محامي'){
                $case->update([
                   'status' => 'rejected'
                ]);
                return response()->json([
                 'message' => 'Case File rejected successfully'
                ]);
            }
        }
        
    }

    public function getCaseFileBycaseId($case_id){
        $user = Auth::user();
        if($user){
            return response()->json([
                'caseFile' => CaseFile::find($case_id)
            ]);
        }
        
    }


    public function storeContactsMessages(Request $request){
        Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return response()->json([
            'message' => 'Contacts Messages added successfully'
           ]);
    }
    public function getAllContactsMessages(){
        
        return response()->json([
            'contactsMessages' => Contact::all()
           ]);
    }
}
