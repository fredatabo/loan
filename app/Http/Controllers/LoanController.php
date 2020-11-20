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
        $loantype = $request->loantype;
        $state = $request->state; //state in which property is located
        $description =  $request->description; //description and location of property
        $lga =  $request->lga; //local government area of property
        $designation = $request->designation; //ministr/parastatal
       
       
        

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

        $maxAmount = $cieling->cieling;

       // return response()->json(["cieling" => $maxAmount ]);


        $amountExpected = $request->amountExpected;

        if( $amountExpected > $maxAmount) {
          return response()->json(["status" => "failed", "message" => "you are not entitled to such amount.", 'ceiling' => $cieling]);
        }  

        $dateofbirthForCal = new DateTime($dateofbirth);
        $dateofappointmentForCalc = new DateTime($dateofappointment);
  
        $today = new Datetime(date('Y-m-d'));
       
  $diff = $today->diff($dateofbirthForCal);
        $age = $diff->y;
      
      
       
        $yearsInService = $today->diff($dateofappointmentForCalc)->y;
  
       
        $determinant = $yearsInService + $age;
  
        
        //get number of years left in service
        $yearsLeft = 0;
  
        if($determinant >= 60) {
            $yearsLeft = 60 - $age;
  
        }
  
        else {
            $TyearsLeft = 35 - $yearsInService;
        if(($age + $TyearsLeft) >= 60) {
        $yearsLeft = 60 - $age;  
        }
        else {
          $yearsLeft = 35 - $yearsInService;
        }
        }
            //this section calculates, monthly payments, total interest to be paid                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
        
       // 'description', 'state','lga','town', 'noofyears', 'amount' amountpermonth,noofmonths

       //formula for calculating anuity and no of years to pay etc

/*
P = PV × r /1 − (1+r)−n 
p = amount to be paid per month
pv = cieling
r = rate
n= number of months

*/

// The calculations below will be subjected to further scrutiny
   $noofmonths = (($yearsLeft - 1) *12);
 
        $pv =  $amountExpected;
        $r = 0.03;
        $power = pow(1 + 0.03,-($noofmonths));

        $p = (($amountExpected ) * ($r)/(1-$power));

        $totalPayback = $p * $noofmonths;
        $compundInterest = ($totalPayback - $pv);

    
       /*
          return response()->json(["yearsLeft" => $yearsLeft , "months" => $noofmonths, 'per month' => $p, 'totalpayback' => $totalPayback, 
          'compond intesrest' => $compundInterest]);
*/

          $loan = LoanTable::create([
            'user_id' => $id,
           
            'state' => $state,
            
            'lga' => $lga,
            'description' => $description,
            'noofmonths' => $noofmonths,
            'noofyears' => $yearsLeft-1,
            'amount' => $amountExpected,
           'loantype' => $loantype,
            'designation' => $designation,
            'totalpayback' => $compundInterest,
            'permonth' => $p
        ]);

        //'total', 'cieling', 'permonth','user_id'
        $paymentSchedule = RepaymentSchedule::create([

          'total' => $compundInterest,
          'cieling' => $amountExpected,
          'permonth' => $p,
          'user_id' => $id

            
        ]);


        if($loan && $paymentSchedule) {
          return response()->json(["success" => true]);
        } 
        
    else {
      return response()->json(["success" => false]);
    }

      }
   


}
