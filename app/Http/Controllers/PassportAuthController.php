<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\PersonalInfo;
use Mail;
use App\Mail\Mailer;



class PassportAuthController extends Controller
{
    /**
     * Registration Req
     */

     private $status = 200;
    public function register(Request $request)
    {
        $this->validate($request, [
            
            'email' => 'required|email',
            'password' => 'required|min:8',
            'ipssno' => 'required|min:4',
        ]);
      $verifyemail= "no";
      $verifypaystatus =  "no"; 

      $email = $request->email;
      $ipssno = $request->ipssno;
      
      // $emailCount =   User::whereEmail($email)->count();
      // $ipssnoCount =   User::whereIpssno($ipssno)->count();

      $emailCount =   User::where('email',$email)->count();
      $ipssnoCount =   User::where('ipssno',$ipssno)->count();

      if($emailCount >= 1) {
        return response()->json(["status" => "failed", "message" => "Email has been used  already."]);
      }

      if($ipssnoCount >= 1) {
        return response()->json(["status" => "failed", "message" => "IPSS has been used  already."]);
      }
    
     $token  = md5( rand(0,1000));
     // $url = url('api/signup/activate/'.$token);
      $url = url('api/signup/activate/'.$token);
        if(($emailCount < 1) && ($ipssnoCount < 1)){
        $user = User::create([
            'ipssno' => $request->ipssno,
            'email' => $request->email,
            'verifyemail' => $verifyemail,
            'verifypaystatus' => $verifypaystatus,
            'password' => bcrypt($request->password),
            'activation_token' => $token
        ]);
         
        $userData =   User::where('email',$email)->first();
        
        $id = $userData->id;
        PersonalInfo::create([
          'surname' => strtoupper($request->surname),
          'firstname' => strtoupper($request->firstname),
          'middlename' => strtoupper($request->middlename),
           'phone'=> $request->phone,
           'user_id'=>$id
        ]);
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        $user = [
            'name' => $request->surname." ".$request->firstname,
            'info' => 'Welcome click or copy this link below to verify your email'.' '.$url
        ];
    
        \Mail::to($request->email)->send(new \App\Mail\NewMail($user));
 
        return response()->json(['token' => $token], 200);
         }
    }
 
    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

   
    public function signupActivate($token)
{
    $user = User::where('activation_token', $token)->first();  
      if (!$user) {
        return response()->json([
            'message' => 'This activation token is invalid.'
        ], 404);
    }    $user->active = true;
    $user->activation_token = '';
    $user->verifyemail = 'yes';
    $user->save();    
    return $user;
}

//find user

public function getUserById($id)
    {
        $post = auth()->user()->personal_infos()->find($id);
 
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found '
            ], 400);
        }
 
        return response()->json([
           // 'success' => true,
            'data' => $post->toArray()
        ], 400);
    }


/**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    

}
