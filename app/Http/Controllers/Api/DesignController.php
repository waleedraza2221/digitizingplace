<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Design;
use App\SourceFiles;
class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $id = Auth::user()->id;
        // dd($request->all());
        //  dd($id);
        //'name' =>$request->name,
          

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
            
        
    
    return response()->json(['Error', 'Records Adding Erro'], 403);

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
