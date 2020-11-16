<?php

namespace App\Http\Controllers;
use App\PersonalInfo;
use App\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FileuploadController extends Controller
{
    //
    public function uploadPhoto(Request $request, $id)
{
   // $person = auth()->user()->personal_infos()->find($id);
/*
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
            'message' => 'Personal info not found'
        ], 400);
    }

 
    $user1 = User::where('id', $person->user_id)->first();  

    if(($user1->verifyemail == "yes") && ($user1->verifypaystatus == "yes") ) {

/*
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
    

    $this->validate($request, [
            
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        
    ]);
/*
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      */
    // codes  for file upload
    $image = $request->get('file');
          $name = $id. time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('file'))->save(public_path('images/photo/').$name);

          $path  = url('images/photo/'.$name);

          $updated =    $person->update([
              'photo' => $path
                 //'photo' => '/storage/'.$path;
                 
                
             ]);

         

 //   $updated = $person->fill($request->all())->save();

    if ($updated) {
        return response()->json([
            'success' => true,
            'message' => 'file uploaded successfully',
           
        ]); }

    else {
        return response()->json([
            'success' => false,
            'message' => 'Error uploading file'
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

//upload letter of appointment

public function uploadLetterAppointment(Request $request, $id)
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

/*
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
    

    $this->validate($request, [
            
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        
    ]);

    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      */
    // codes  for file upload
    $image = $request->get('file');
          $name = $id. time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('file'))->save(public_path('images/appointment/').$name);

          $path  = url('images/appointment/'.$name);

          $updated =    $person->update([
              'appointmentConfirmation' => $path
                 //'photo' => '/storage/'.$path;
                 
                
             ]);

         

 //   $updated = $person->fill($request->all())->save();

    if ($updated) {
        return response()->json([
            'success' => true,
            'message' => 'file uploaded successfully',
           
        ]); }

    else {
        return response()->json([
            'success' => false,
            'message' => 'Error uploading file'
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



// payslip

public function uploadPaySlip(Request $request, $id)
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

/*
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
    

    $this->validate($request, [
            
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        
    ]);
/*
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      */
    // codes  for file upload
    $image = $request->get('file');
          $name = $id. time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('file'))->save(public_path('images/payslip/').$name);

          $path  = url('images/payslip/'.$name);

          $updated =    $person->update([
              'appointmentConfirmation' => $path
                 //'photo' => '/storage/'.$path;
                 
                
             ]);

         

 //   $updated = $person->fill($request->all())->save();

    if ($updated) {
        return response()->json([
            'success' => true,
            'message' => 'file uploaded successfully',
           
        ]); }

    else {
        return response()->json([
            'success' => false,
            'message' => 'Error uploading file'
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




// gazzette

public function uploadGazzette(Request $request, $id)
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

/*
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
    

    $this->validate($request, [
            
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        
    ]);
/*
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      */
    // codes  for file upload
    $image = $request->get('file');
          $name = $id. time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('file'))->save(public_path('images/gazzette/').$name);

          $path  = url('images/gazzette/'.$name);

          $updated =    $person->update([
              'appointmentConfirmation' => $path
                 //'photo' => '/storage/'.$path;
                 
                
             ]);

         

 //   $updated = $person->fill($request->all())->save();

    if ($updated) {
        return response()->json([
            'success' => true,
            'message' => 'file uploaded successfully',
           
        ]); }

    else {
        return response()->json([
            'success' => false,
            'message' => 'Error uploading file'
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


// surety

public function uploadSurety(Request $request, $id)
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

/*
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
    

    $this->validate($request, [
            
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        
    ]);
/*
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      */
    // codes  for file upload
    $image = $request->get('file');
          $name = $id. time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('file'))->save(public_path('images/surety/').$name);

          $path  = url('images/surety/'.$name);

          $updated =    $person->update([
              'appointmentConfirmation' => $path
                 //'photo' => '/storage/'.$path;
                 
                
             ]);

         

 //   $updated = $person->fill($request->all())->save();

    if ($updated) {
        return response()->json([
            'success' => true,
            'message' => 'file uploaded successfully',
           
        ]); }

    else {
        return response()->json([
            'success' => false,
            'message' => 'Error uploading file'
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


// reason

public function uploadReason(Request $request, $id)
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

/*
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
    

    $this->validate($request, [
            
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        
    ]);
/*
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      */
    // codes  for file upload
    $image = $request->get('file');
          $name = $id. time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('file'))->save(public_path('images/reason/').$id.$name);

          $path  = url('images/reason/'.$name);

          $updated =    $person->update([
              'appointmentConfirmation' => $path
                 //'photo' => '/storage/'.$path;
                 
                
             ]);

         

 //   $updated = $person->fill($request->all())->save();

    if ($updated) {
        return response()->json([
            'success' => true,
            'message' => 'file uploaded successfully',
           
        ]); }

    else {
        return response()->json([
            'success' => false,
            'message' => 'Error uploading file'
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

public function uploadPhotoWithoutAuth(Request $request, $id)
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


$validator = $request->validate([
    'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ]);

  if ($validator->fails()) {
    return sendCustomResponse($validator->messages()->first(), 'error', 500);
}
**/

$person = PersonalInfo::where('user_id', $id)->first(); 
    if (!$person) {
        return response()->json([
            'success' => false,
            'message' => 'Personal info not found'
        ], 400);
    }

 
    $user1 = User::where('id', $person->user_id)->first();  

    if(($user1->verifyemail == "yes") && ($user1->verifypaystatus == "yes") ) {

/*
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
    */
    // codes  for file upload
   // $path = $request->file('file')->storeAs('uploads', $imageName, 'public');

  
    $image = $request->get('file');
          $name = $id. time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        \Image::make($request->get('file'))->save(public_path('images/photo/').$name);

        $path  = url('images/photo/'.$name);

 $updated =    $person->update([
     'photo' => $path
        //'photo' => '/storage/'.$path;
        
       
    ]);
//photo => public/images/.$name
 //   $updated = $person->fill($request->all())->save();

    if ($updated) {
        return response()->json([
            'success' => true,
            'message' => 'file uploaded successfully',
           
        ]); }

    else {
        return response()->json([
            'success' => false,
            'message' => 'Error uploading file'
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



}
