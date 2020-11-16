<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalInfo;
use App\User;
use App\Cieling;

use Illuminate\Support\Facades\Auth;

// Get the currently authenticated user...


class PersonalInfoController extends Controller
{
    //


    //find user
    public function index()
    {
        $posts = auth()->user()->personal_infos
        ;
 
        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }


public function getUserById($id)
{
   // $person = auth()->user()->personal_infos()->find($id);

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
       
    else {
        $id = Auth::id();
    
      
    }
    $person = PersonalInfo::where('user_id', $id)->first(); 

    if (!$person) {
        return response()->json([
            'success' => false,
            'message' => 'information not found '
        ], 400);
    }

    return response()->json([
       // 'success' => true,
        'data' => $person->toArray()
    ], 400);
}


public function updateBioData(Request $request, $id)
{
   // $person = auth()->user()->personal_infos()->find($id);

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
   
else {
    $id = Auth::id();

  
}
$person = PersonalInfo::where('user_id', $id)->first(); 
    if (!$person) {
        return response()->json([
            'success' => false,
            'message' => 'Personal info not found'
        ], 400);
    }

 
    $user1 = User::where('id', $person->user_id)->first();  

    if(($user1->verifyemail == "yes") && ($user1->verifypaystatus == "yes") ) {


    $this->validate($request, [
            
        'surname' => 'required|min:3',
        'firstname' => 'required|min:3',
        'phone' => 'required|min:3',
       
        'dateOfBirth' => 'required|min:3',
        'state' => 'required|min:3',
        'lga' => 'required|min:3',
        'residentialAddress' => 'required|min:3',
        'currentAddress' => 'required|min:3',
    ]);

 $updated =    $person->update([
        'surname' => strtoupper($request->surname),
        'firstname' => strtoupper($request->firstname),
        'middlename' => strtoupper($request->middlename),
        'maidenname' => strtoupper($request->maidenname),
        'serviceno' => strtoupper($request->serviceno),
        'dateOfBirth' => $request->dateOfBirth,
        'state' => strtoupper($request->state),
        'lga' => strtoupper($request->lga),
        'phone' => $request->phone,
        'residentialAddress' => $request->residentialAddress,
        'currentAddress' => $request->currentAddress
       
    ]);

 //   $updated = $person->fill($request->all())->save();

    if ($updated) {
        return response()->json([
            'success' => true,
            'message' => 'Personal info  updated',
            'data' => $person->toArray()
        ]); }

    else {
        return response()->json([
            'success' => false,
            'message' => 'Error updating record'
        ], 500);
    }

}

else {

    return response()->json([
        'success' => false,
        'message' => 'Email must be verified and payment must be made before you can proceed',
        'email' => $user->verifyemail,
        'paystatus' => $user->verifypaystatus
    ], 500);

}

}


//update appointment information

public function updateAppointmentInformation(Request $request, $id)
{
   // $person = auth()->user()->personal_infos()->find($id);
   $user = Auth::user();

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
      
   else {
       $id = Auth::id();
   
     
   }
   $person = PersonalInfo::where('user_id', $id)->first(); 
       if (!$person) {
           return response()->json([
               'success' => false,
               'message' => 'Personal info not found'
           ], 400);
       }
   
    
       $user1 = User::where('id', $person->user_id)->first(); 

   
   

    if( ($user->verifyemail == "yes") && ($user->verifypaystatus == "yes") ) {
        
        
       
     /*
 
    $this->validate($request, [
         // check validation codes   
       
        'dateOfFirstAppointment' => 'required|min:3',
        'dateOfcurrentAppointment' => 'required|min:3',
        'ministry' => 'required|min:3',
        'section' => 'required|min:3',
        'rank' => 'required|min:3',
        'lga' => 'required|min:3',
        'level' => 'required|min:3',
        'bankname' => 'required|min:3',
        'accountname' => 'required|min:3',
        'pensionable' => 'required|min:3',
        'accountno' => 'required|min:3',
        
    ]);
    */

 $updated =    $person->update([
        'dateOfFirstAppointment' => $request->dateOfFirstAppointment,
        'dateOfcurrentAppointment' => $request->dateOfcurrentAppointment,
        'ministry' => $request->ministry,
        'section' => $request->section,
        'rank' => $request->rank,
        'level' => $request->level,
        'step' => $request->step,
        'bankname' => $request->bankname,
        'accountname' => $request->accountname,
        'accountno' => $request->accountno,
        'pensionable' => $request->pensionable,
        'pin' => $request->pin,
        'pid' => $request->pid,
        'reason' => $request->reason
    ]);

 //   $updated = $person->fill($request->all())->save();

    if ($updated) {
        return response()->json([
            'success' => true,
            'message' => 'Personal info  updated',
            'data' => $person->toArray(),
            'name' => $person->firstname
        ]); }
    else {
        return response()->json([
            'success' => false,
            'message' => 'Error updating record'
        ], 500); } 

    }

    else {
        return response()->json([
            'success' => false,
            'message' => 'Email must be verified and payment must be made before you can proceed',
            'email' => $user->verifyemail,
            'paystatus' => $user->verifypaystatus
        ], 500);
     
    }

    
}

/**
 * $request->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);

  

        $product->update($request->all());
 */


public function update(Request $request, $id)
{
    $person = auth()->user()->personal()->find($id);

    if (!$person) {
        return response()->json([
            'success' => false,
            'message' => 'Personal info not found'
        ], 400);
    }

    $this->validate($request, [
            
        'email' => 'required|email',
        'password' => 'required|min:8',
        'ipssno' => 'required|min:4',
    ]);

 $updated =    $person->update([
        'name' => $request->name,
        'email' => strtolower($request->email)
    ]);

 //   $updated = $person->fill($request->all())->save();

    if ($updated)
        return response()->json([
            'success' => true
        ]);
    else
        return response()->json([
            'success' => false,
            'message' => 'Email must be verified and payment must be made before you can proceed'
        ], 500);
}


public function getUserByIdWithoutAuth($id)
{
   // $person = auth()->user()->personal_infos()->find($id);

   /** 
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
       
    else {
        $id = Auth::id();
    
      
    }
    */
    
    $person = PersonalInfo::where('user_id', $id)->first(); 

    if (!$person) {
        return response()->json([
            'success' => false,
            'message' => 'information not found '
        ], 400);
    }

    return response()->json([
       // 'success' => true,
        'data' => $person->toArray()
    ], 400);
}



public function submitToEs(Request $request, $id) {

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

   
    if (PersonalInfo::where('id', $id)->exists()) {
      $applicant = PersonalInfo::find($id);
  
      $updated =    $applicant->update([
        'verified' => 'pending'
        
         
    ]);


   

      return response()->json([
        "success" => true,
        "applicant" => $applicant
      ], 200);
    } else {
      return response()->json([
        "message" => "Record not found",
        "success" => false
      ], 404);
    }
  }

}
