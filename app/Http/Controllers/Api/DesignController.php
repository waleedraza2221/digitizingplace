<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Design;
use App\User;
use App\SourceFiles;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRemainderMail;

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function index(Request $request)
        {  
           $user = User::where('email',$request->user()->only('email'))->first();

          
            $designs=Design::where('user_id', $user->id)->where('status','New')->with('SourceFiles')->orderby('id','desc')->get();
            
            return response()->json(['designs' => $designs],200);
        }
        
        public function getallawaitingquote(){
          
          
            $designs=Design::where('status','New')->with('SourceFiles')->orderby('id','desc')->get();
            
            return response()->json(['designs' => $designs],200);
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



    public function sendremainder(Request $request)
    {
        
        $users = User::where('role_id',2)->get();
        $data = ['message' => $request->id];

            foreach($users  as $user){
                
             Mail::mailer('ses')->to('admin@digitizingplace.com')->send(new SendRemainderMail($data));
            
            }
    
        return response()->json(['message'=> 'Thanks for Remind Us we will send link for Payment as soon as possible Thank you :)'], 200);


    }


    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   

    public function store(Request $request)
    {


    $id = Auth::user()->id;
        // dd($request->all());
        //  dd($id);
        //'name' =>$request->name,
          
    //  Mail::to('waleedraza221@gmail.com')->send(new TestAmazonSes('It works!'));
        $design = Design::create([
            'description'=>$request->description,
            'isdigitizing'=>($request->isdigitizing=='true')? 1:0,
            'isvector'=>($request->isvector=='true')? 1:0,
            'user_id'=>$id,
             'status'=>'New',
             'budget'=>$request->budget
        ]);

    $hasfiles = request()->hasFile('sourcefiles');
          if ($hasfiles) {
               $files = request()->file('sourcefiles');
           foreach ($files as $file)
             {

                $fileName = $file->getClientOriginalName();
                $filePath = "/sourcefiles/" . date("YMD") . "/" . rand(10,100000);
                //dd($filePath);
               $path = $file->storeAs($filePath,$fileName, 's3');


               // $path = Storage::disk('s3')->put('uploads/'. date("Y") . '/' . date("m") . '/',  $fileName);
              //  dd($path);
             // 'filename', 'design_id','filepath'
              $sourcefile= SourceFiles::create([
                'filename'=>$fileName,
                'filepath'=>$path,
                'design_id'=>$design->id

              ]);
       }
       return response()->json(['message', 'Records Added Successfully'], 200);
    }
            
        
    
    return response()->json(['Error', 'Records Adding Error'], 403);

    }

  public function viewquote(Request $request){
   

          
    $designs=Design::where('Id', $request->id)->with('user')->with('SourceFiles')->first();
    if($designs!==null){
        foreach($designs->SourceFiles as $i){
            $i->filepath=Storage::disk('s3')->url($i->filepath);

        }
    return response()->json(['designs' => $designs],200);

  }
  }

  public function downloadfiles(Request $request){

    return response()->download(storage_path('app/files/'.$file));
  }


    public function show($id)
    {
        // 
        
            $userid=Auth::user()->id;
         
            if($id!==null){
              
                    $design =Design::where('user_id', $userid)->where('id',$id)->with('SourceFiles')->first();
                    if($design!==null){
                    foreach($design->SourceFiles as $i){
                        $i->filepath=Storage::disk('s3')->url($i->filepath);

                    }
                   
                    if($design->user_id==$userid){
                        return response()->json(['design'=>$design],200);
                    }
                }else{

                    return response()->json(['Error', 'Error in Finding Record'], 403);
                }



            }
        

        return response()->json(['Error', 'Error in Finding Record'], 403);


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
        //
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
    }
}
