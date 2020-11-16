<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Es;
use App\PersonalInfo;
use Mail;
use App\Mail\Mailer;

use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    //

    public function registerEsBySuperAdmin(Request $request)
    {

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

if(Auth::user()->role != 'superadmin') {

    return response()->json([
        'success' => false,
        'message' => 'error! you are no authorized to perform this operation'
    ], 400);
    
}
    
        $this->validate($request, [
            
            'email' => 'required|email',
            'password' => 'required|min:8',
            'ipssno' => 'required|min:4',
            'firstname' => 'required|min:4',
            'surname' => 'required|min:4',
            'phone' => 'required|min:4',
            'level' => 'required|min:4',
            'username' => 'required|min:4',
        ]);
        
      $verifyemail= "no";
      $verifypaystatus =  "no"; 
      $role = 'es';
      $date4 = date("Y-m-d : H:i:s",time());

      $username = $request->username;
     // $ipssno = $request->ipssno;
      
      // $emailCount =   User::whereEmail($email)->count();
      // $ipssnoCount =   User::whereIpssno($ipssno)->count();

      $usernameCount =   User::where('username',$username)->count();
     // $ipssnoCount =   User::where('ipssno',$ipssno)->count();

      if($usernameCount >= 1) {
        return response()->json(["status" => "failed", "message" => "username already exist."]);
      }

     
    
    // $token  = md5( rand(0,1000));
     // $url = url('api/signup/activate/'.$token);
     // $url = url('api/signup/activate/'.$token);
        if($usernameCount < 1){
        $user = User::create([
            'username' => $request->username,
           
            'password' => bcrypt($request->password),
            
            'role' => $role,
            'verifyemail' => 'es',
            'verifypaystatus' => 'es',
            'ipssno' => 'es'.$date4,
            'email' => 'es'.$date4
        ]);
        $today = date("Y-m-d");
        $userData =   User::where('username',$username)->first();
        
        $id = $userData->id;
        Es::create([
          'surname' => strtoupper($request->surname),
          'firstname' => strtoupper($request->firstname),
          'middlename' => strtoupper($request->middlename),
          'username' => $request->username,
          'level' => strtoupper($request->level),
          'ipssno' => strtoupper($request->ipssno),
           'phone'=> $request->phone,
           'dateadded' => $today,
           'email' => $request->email,
           'user_id'=>$id
        ]);
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        $user = [
            'name' => $request->surname." ".$request->firstname,
            'info' => 'Welcome login to ES dashboard with these credentials  username :'.$request->username
            ." "."password"." ".$request->password,
            'username' => $request->username,
            'password' => $request->password
        ];
    
        \Mail::to($request->email)->send(new \App\Mail\EsMail($user));
 
        return response()->json(['token' => $token, 'success' => true], 200);
         }
         
    }

    

   // delete ES records
    public function deleteEs ($id) {

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

        if(Auth::user()->role != 'superadmin') {

            return response()->json([
                'success' => false,
                'message' => 'error! you are no authorized to perform this operation'
            ], 400);
            
        }

        if(Es::where('id', $id)->exists()) {
          $es = Es::find($id);

          $user1 = User::where('username', $es->username)->first(); 
          $es->delete();
          $user1->delete();
  
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "Es record not found"
          ], 404);
        }
      }


      // get all Es

      public function getAllEs() {
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

        if(Auth::user()->role != 'superadmin') {

            return response()->json([
                'success' => false,
                'message' => 'error! you are no authorized to perform this operation'
            ], 400);
            
        }
        $es = Es::get()->toJson(JSON_PRETTY_PRINT);
        return response($es, 200);
      }
      

  // get Es record by id

  public function getEsRecordById($id) {
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

    if(Auth::user()->role != 'superadmin') {

        return response()->json([
            'success' => false,
            'message' => 'error! you are no authorized to perform this operation'
        ], 400);
        
    }
    if (Es::where('id', $id)->exists()) {
      $es = Es::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($es, 200);
    } else {
      return response()->json([
        "message" => "record not found"
      ], 404);
    }
  }


  public function updateEsRecord(Request $request, $id) {

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

    if(Auth::user()->role != 'superadmin') {

        return response()->json([
            'success' => false,
            'message' => 'error! you are no authorized to perform this operation'
        ], 400);
        
    }
    if (Es::where('id', $id)->exists()) {
      $es = Es::find($id);
   /*
     

      $es->surname = is_null(strtoupper($request->surname)) ? $es->surname : $es->surname;
      $es->firstname = is_null(strtoupper($request->firstname)) ? $es->firstname : $es->firstname;
      $es->middlename = is_null(strtoupper($request->middlename)) ? $es->middlename : $es->middlename;
      $es->level = is_null(strtoupper($request->level)) ? $es->level : $es->level;
      $es->ipssno = is_null(strtoupper($request->ipssno)) ? $es->ipssno : $es->ipssno;
      $es->phone = is_null($request->phone) ? $es->phone : $es->phone;
      $es->email = is_null($request->email) ? $es->email : $es->email;
      $es->save();
      */
      $updated =    $es->update([
        'surname' => strtoupper($request->surname),
          'firstname' => strtoupper($request->firstname),
          'middlename' => strtoupper($request->middlename),
          
          'level' => strtoupper($request->level),
          'ipssno' => strtoupper($request->ipssno),
           'phone'=> $request->phone,
          
           'email' => $request->email,
         
    ]);


   

      return response()->json([
        "message" => "records updated successfully",
        "es" => $es
      ], 200);
    } else {
      return response()->json([
        "message" => "Record not found"
      ], 404);
    }
  }

}
