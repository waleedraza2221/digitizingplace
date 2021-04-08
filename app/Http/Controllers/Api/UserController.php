<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Profile;
use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetEmail;
use App\Mail\passwordchanged;
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
