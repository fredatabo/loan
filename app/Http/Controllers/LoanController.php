<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Es;
use App\PersonalInfo;
use App\LoanTable;
use App\Cieling;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    //

    public function getCielingByLevel($level) {

   
       
        if (Cieling::where('level', $level)->exists()) {
          $cieling = Cieling::where('level', $level)->get()->toJson(JSON_PRETTY_PRINT);
          return response($cieling, 200);
        } else {
          return response()->json([
            "message" => "record not found"
          ], 404);
        }
      }


      public function getCielings() {
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
      
       
        
        $cielings = Cieling::get()->toJson(JSON_PRETTY_PRINT);
        return response($cielings, 200);
      }



      public function applyForLoanStage1(Request $request, $id) {
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
      /** 
        if(Auth::user()->role != 'applicant') {

            return response()->json([
                'success' => false,
                'message' => 'error! you are no authorized to perform this operation'
            ], 400);
            
        }

        */
        $loanType = $request->loantype;
        $amount = $request->amount;
        $numberofyears = $request->numberofyears;
        

        //get applicantrecord from personalinfo table
        
        $person = PersonalInfo::where('user_id', $id)->first(); 

        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => 'information not found '
            ], 400);
        }

        $dateofbirth = $person->dateOfBirth;
        $dateofappointment = $person->dateOfFirstAppointment;
        $level = $person->level;

        //get cieling by level
        $cieling = Cieling::where('level', $level)->first(); 

        
    

      }
   


}
