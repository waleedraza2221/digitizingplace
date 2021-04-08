<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Profile;
use App\Role;
use App\User;
use App\BillingInfo;
use App\BalanceHistory;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetEmail;
use App\Mail\passwordchanged;
use Illuminate\Support\Facades\Hash;
use App\Providers\HashValidationTool;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->per_page ? $request->per_page : 5;
        $sortBy = $request->sort_by ? $request->sort_by : 'name';
        $orderBy = $request->order_by ? 'asc' : 'desc';
        return response()->json([
            'users' => new UserCollection(User::orderBy($sortBy, $orderBy)->paginate($per_page)),
            'roles' => Role::pluck('name')->all()
        ], 200);
    }

    public function getBalance(Request $request)
    {
        return  response()->json(['balance'=>User::find(Auth::user()->id)->balance], 200);
    }


    const SHA_256 = 'sha256';
    
    public function savepaymentinfo(Request $request){
     $merchantCode = "250278707506";   
     $key = "Z%^H@GwDVIQAny=3O!8?"; 
     $apiVersion = '6.0'; 
     $resource = 'orders';
     $host = "https://api.2checkout.com/rest/".$apiVersion."/".$resource."/".$request->params['refno'];
     $date = gmdate('Y-m-d H:i:s');
     $string = strlen($merchantCode) . $merchantCode . strlen($date) . $date; 
     $hash = hash_hmac('md5', $string, $key);
     $payload = '';
     $ch = curl_init();
     $headerArray = array(
     
         "Content-Type: application/json",
     
         "Accept: application/json",
    
         "X-Avangate-Authentication: code=\"{$merchantCode}\" date=\"{$date}\" hash=\"{$hash}\"",
     
         'Cookie: XDEBUG_SESSION=PHPSTORM'
     
     );
     
      
     
     curl_setopt($ch, CURLOPT_URL, $host);
     
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
     
     curl_setopt($ch, CURLOPT_HEADER, FALSE);
     
     curl_setopt($ch, CURLOPT_POST, FALSE);
     
     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
     
     curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
     
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
     
     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
     
     curl_setopt($ch, CURLOPT_SSLVERSION, 0);
     
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
    
      
    
     $response = curl_exec($ch);
     $data = json_decode($response);
     if($data->Status=='COMPLETE'){
        $user=User::find(Auth::user()->id);
        $balHistory= BalanceHistory::where('refid',$request->params['refno'])->first();
        if(is_null($balHistory)){
            $bh=new BalanceHistory([
                'refid' =>$request->params['refno'],
                'amount'=>$user->amount,
                'user_id'=>$user->id
            ]);
          $bh->save();   
          $user->balance=$user->balance+$user->amount;
          $user->save();
         $mess = ['message' => $user->amount];
          Mail::to($user->email)->send(new PasswordResetEmail($mess));
          return  response()->json(['message'=>'success'], 200);
       }



     }
     return  response()->json(['message'=>'Error'], 403);
        

    }





    public function getpersonalinfo(Request $request){

        $user = Auth::user();
       
        $u=User::where('email',$user->email)->first();
   
        $billing= BillingInfo::where('user_id',$user->id)->first();
       
          return response()->json(['billing'=>$billing,'name'=>$u->name,'phone'=>$u->phone,'email'=>$u->email], 200);

    }



    public function resetpassword(Request $request)
    {

        if ($request->ajax()) {

           $user= User::where('email', $request->email)->first();
      
           if($user!==null){

                
           $resettoken= Str::random(80);
           $emailencryption= bcrypt($request->email);
           $user->api_token=$resettoken;
           $user->save();
            $data = ['message' => 'asse='.$emailencryption.'&assett='.$resettoken];

            Mail::to($request->email)->send(new PasswordResetEmail($data));

            return response()->json(['status'=> 'A Passowrd Reset Link has been sent to your mail Kindly Check your mailbox '], 200);

           }
       

               
        
        }

        return response()->json(['status'=> 'Email does not exist Please enter Correct Email'], 403);
    
    }



    public function resetsetpassword(Request $request)
    {

        if ($request->ajax()) {

           $user= User::where('api_token', $request->t)->first();
           
           if($user!==null){

         
                    $user->password=bcrypt($request->password);
                    $user->save();

                    $data = ['message' => 'Password has sucessfully changed'];

                    Mail::to($user->email)->send(new passwordchanged($data));
        
                    return response()->json(['status'=> 'Password has been changed kindly Login here'], 200);
         
         
         
           

           }
       

               
        
        }

        return response()->json(['status'=> 'Error Occur Kindly Contact Admin'], 403);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = isset($request->role) ? Role::where('name', $request->role)->first() : Role::where('name', 'Subscriber')->first();
        $user = new User([
            'name' =>$request->name,
            'email'=>$request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->role()->associate($role);
        $user->save();
        $user->profile()->save(new Profile);
        return response()->json(['user'=> new UserResource($user)], 200);
    }
 public function savepersonalinfo(Request $request){
    if(isset($request->name) && isset($request->phone)){
        $user = Auth::user();      
        $u=User::where('email',$user->email)->first();
        $u->name=$request->name;
        $u->phone=$request->phone;
        $u->save();

    return response()->json(['message'=> 'Settings changed Successfully :)'], 200);
    }else{
        return response()->json(['message'=> 'Unable to change Settings'], 403);
    } 
}


//savebillinginfo
public function savebillinginfo(Request $request){

  
    if(isset($request->billing)){
  
       
        $billing = BillingInfo::find($request['billing']['id']);
        $billing->name=$request['billing']['name'];
        $billing->phone=$request['billing']['phone'];
        $billing->email=$request['billing']['email'];
        $billing->address1=$request['billing']['address1'];
        $billing->address2=$request['billing']['address2'];
        $billing->postalcode=$request['billing']['postalcode'];
        $billing->city=$request['billing']['city'];
        $billing->state=$request['billing']['state'];
        $billing->country=$request['billing']['country'];

        $billing->save();
      

    return response()->json(['message'=> 'Billing Info changed Successfully :)'], 200);
    }else{
        return response()->json(['message'=> 'Unable to change Settings'], 403);
    } 
}


//getamount
public function getamount(Request $request){
    
    $user=User::find(Auth::user()->id);
     $user->fill([
        'amount' => $request->amount
        ])->save();
    return response()->json(['succress'=> 'true'], 200);
}
//Update Password


public function savepassword(Request $request){
    
    $user = Auth::user();
    $usr = User::findOrFail($user->id);   
    if (Hash::check($request->oldpassword, $usr->password)) {

        $user->fill([
            'password' => Hash::make($request->newpassword)
            ])->save();

            return response()->json(['message'=> 'Password has changed successfully'], 200);
     }
   
        
            return response()->json(['message'=> 'Old password is wrong please try again'], 403);
        
        }




//Client Register
    public function registerclient(Request $request)
    {
        $role = isset($request->role) ? Role::where('name', $request->role)->first() : Role::where('name', 'Client')->first();
        $user = new User([
            'name' =>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password' => bcrypt($request->password),
        ]);
        $user->role()->associate($role);
        $user->save();
        $user->profile()->save(new Profile);
        $user->BillingInfo()->save(new BillingInfo([
            'name'=>$user->name,
            'email'=>$user->email,
            'phone'=>$user->phone
    ]));
        if ($request->ajax()) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $token = Str::random(80);
                Auth::user()->api_token = $token;
                Auth::user()->save();
                $isClient = Auth::user()->isClient();
                return response()->json(['token'=>$token, 'isClient' => $isClient], 200);
            }
        }

        return response()->json(['status'=> 'Email or Password is Wrong'], 403);


        return response()->json(['user'=> new UserResource($user)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::where('name', 'LIKE', "%$id%")->paginate();
        return response()->json(['users' => $users], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::where('name', $request->role)->first();
        $user = User::find($id);
        $user->name = $request->name;
        $user->role()->dissociate($user->role);
        $user->role()->associate($role);
        $user->save();
        return response()->json(['user'=> new UserResource($user)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        Profile::where('user_id', $id)->delete();
        return  response()->json(['user'=>$user], 200);
    }

    public function deleteAll(Request $request)
    {
        User::whereIn('id', $request->users)->delete();
        return response()->json(['message', 'Records Deleted Successfully'], 200);
    }
    
    public function login(Request $request)
    {
        if ($request->ajax()) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $token = Str::random(80);
                Auth::user()->api_token = $token;
                Auth::user()->save();
                $admin = Auth::user()->isAdmin();
                return response()->json(['token'=>$token, 'isAdmin' => $admin], 200);
            }
        }

        return response()->json(['status'=> 'Email or Password is Wrong'], 403);
    }

    public function clientlogin(Request $request)
    {
        if ($request->ajax()) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $token = Str::random(80);
                Auth::user()->api_token = $token;
                Auth::user()->save();
                $client = Auth::user()->isClient();
                return response()->json(['token'=>$token, 'isClient' => $client], 200);
            }
        }

        return response()->json(['status'=> 'Email or Password is Wrong'], 403);
    }


    public function verify(Request $request)
    {
        echo $request;
        return $request->user()->only('name', 'email');
    }
    public function verifyRole(Request $request)
    {
        $client = Auth::user()->isAdmin();
        return response()->json(['isAdmin'=> $client], 200);
    }

    //verifyRole
    public function changeRole(Request $request)
    {
        $user = User::find($request->user);
        $logedInUser = $request->user();
        if ($user->id === $logedInUser->id) {
            return response()->json(['user'=> new UserResource($logedInUser)], 422);
        }
        $role = Role::where('name', $request->role)->first();
        $user->role()->associate($role);
        $user->save();
        return response()->json(['user' => new UserResource($user)], 200);
    }
    public function changePhoto(Request $request)
    {
        $user = User::find($request->user);
        $profile = Profile::where('user_id', $request->user)->first();
        $ext = $request->photo->extension();
        $photo = $request->photo->storeAs('images', Str::random(20).".{$ext}", 'public');
        $profile->photo = $photo;
        $user->profile()->save($profile);
        return response()->json(['user' => new UserResource($user)], 200);
    }
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users'
        ]);

        return response()->json(['message'=> 'Valid Email'], 200);
    }
}
