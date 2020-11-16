<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Es;
use App\PersonalInfo;
use Mail;
use App\Mail\Mailer;

use Illuminate\Support\Facades\Auth;

class EsController extends Controller
{
    //
    // function to get all appplicants from personal info table

    public function getAllApplicants() {
        $user = Auth::user();

        // Get the currently authenticated user's ID...
        //$id = Auth::id();
        
            if (!Auth::check())
        {
            // The user is logged in...
            
            // for other fields other than the primary key
            //$email = Auth::user()->email;
            return response()->json([
                'success' => false,
                'message' => 'user is not logged in'
            ], 400);
        }
      
        if(Auth::user()->role != 'es') {

            return response()->json([
                'success' => false,
                'message' => 'error! you are no authorized to perform this operation'
            ], 400);
            
        }
        
        $applicants = PersonalInfo::get()->toJson(JSON_PRETTY_PRINT);
        return response($applicants, 200);
      }
   
       // get all applicants where status is pending

       public function getAllApplicantsPending() {
        $user = Auth::user();

        // Get the currently authenticated user's ID...
        //$id = Auth::id();
        
            if (!Auth::check())
        {
            // The user is logged in...
            
            // for other fields other than the primary key
            //$email = Auth::user()->email;
            return response()->json([
                'success' => false,
                'message' => 'user is not logged in'
            ], 400);
        }

        if(Auth::user()->role != 'es') {

            return response()->json([
                'success' => false,
                'message' => 'error! you are no authorized to perform this operation'
            ], 400);
            
        }
       // $applicants = PersonalInfo::where('verified', 'pending')->toJson(JSON_PRETTY_PRINT);
        $applicants = PersonalInfo::where('verified', 'pending')->get();
       // User::where('username', $es->username)->first();
        return response($applicants, 200);
      }

      // es function to get single applicant

      public function getApplicantRecordById($id) {
        $user = Auth::user();
    
        // Get the currently authenticated user's ID...
        //$id = Auth::id();
        
            if (!Auth::check())
        {
            // The user is logged in...
            
            // for other fields other than the primary key
            //$email = Auth::user()->email;
            return response()->json([
                'success' => false,
                'message' => 'user is not logged in'
            ], 400);
        }

        if(Auth::user()->role != 'es') {

            return response()->json([
                'success' => false,
                'message' => 'error! you are no authorized to perform this operation'
            ], 400);
            
        }
        if (PersonalInfo::where('id', $id)->exists()) {
          $applicant = PersonalInfo::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
          return response($applicant, 200);
        } else {
          return response()->json([
            "message" => "record not found"
          ], 404);
        }
      }

      // function to approve pending records

      public function verifyRecords(Request $request, $id) {

        $user = Auth::user();
    
        // Get the currently authenticated user's ID...
        //$id = Auth::id();
        
            if (!Auth::check())
        {
            // The user is logged in...
            
            // for other fields other than the primary key
            //$email = Auth::user()->email;
            return response()->json([
                'success' => false,
                'message' => 'user is not logged in'
            ], 400);
        }

        if(Auth::user()->role != 'es') {

            return response()->json([
                'success' => false,
                'message' => 'error! you are no authorized to perform this operation'
            ], 400);
            
        }
        if (PersonalInfo::where('id', $id)->exists()) {
          $applicant = PersonalInfo::find($id);
      
          $updated =    $applicant->update([
            'verified' => 'yes'
            
             
        ]);
    
    
       
    
          return response()->json([
            "message" => "records updated successfully",
            "success" => true,
            "applicant" => $applicant
          ], 200);
        } else {
          return response()->json([
            "message" => "Record not found",
            "success" => "false"
          ], 404);
        }
      }


      public function getAllApplicantsWithoutAuth() {
      
        $applicants = PersonalInfo::get()->toJson(JSON_PRETTY_PRINT);
        return response($applicants, 200);
      }


}
