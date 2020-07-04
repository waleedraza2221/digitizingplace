<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserController extends Controller
{

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return response()->json(['users'=>User::all()],200);
    }

    /**
     * Show the form for creating a new resource.
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
          $user=  User::create([

            'name'=>$request->name,
            'email'=>$request->email,
            ]);
            return response()->json(['user'=>$user],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
       $user=User::find($id);
       $user->name=$request->name;
       $user->save();
       return response()->json(['user'=>$user],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user=User::find($id)->delete();
        return response()->json(['user'=>$user],200);
    }

    //
    public function login(Request $request){
            $credentials=$request->only('email','password');
              //  echo jason_encode($credentials);exit;
                if(Auth::attempt($credentials)){
                    $token=Str::random(80);
                    Auth::user()->api_token=$token;
                    Auth::user()->save();
                   $admin=Auth::user()->isAdmin();
                    return response()->json(['token'=>$token,'isAdmin'=>$admin],200);
                }

           return response()->json(['status'=>'Email or Password is Wrong'],403);
         
    }


    public function verify(Request $request){

        return $request->user()->only('name','email');
    }
}
