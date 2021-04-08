<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\BalanceHistory;
use Auth;
use DateTime;
use App\Providers\HashValidationTool;

class BalanceHistoryController extends Controller
{
    //
    public function index(Request $request)
    {

        //dd($request);
        $per_page = $request->per_page ? $request->per_page : 5;
        $sortBy = $request->sort_by ? $request->sort_by : 'created_at';
        $orderBy = $request->order_by ? 'desc' : 'asc';
        $data=BalanceHistory::where('user_id',Auth::user()->id)->orderBy($sortBy, $orderBy)->paginate($per_page);
        return response()->json([
            'balancehistory' => $data
        ], 200);
    }

      /**
     * Display the specified resource.
     *
     * @param  \App\$profile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $obj=new HashValidationTool();
       
       if(BalanceHistory::where('user_id',Auth::user()->id)->where('refid',$request->id)->first()){
        return response()->json([
            'balancehistory' =>$obj->getInvoiceInfo($request->id)
        ], 200);
       }
       return response()->json([
        'message' =>'You are not Allowed to View this '
    ], 403);
        
    }



}
