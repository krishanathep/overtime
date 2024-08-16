<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TruApprover;

class ApproverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approver = TruApprover::all();
        return response()->json([
            'status' => 200,
            'approver' => $approver,
        ]);
    }
    
    public function dept_filter(Request $request)
    {
        $data = $request->get('data'); 
       
        $approver = TruApprover::where('title', '=', $data)
        ->get();

        return response()->json([
            'status'=> 200,
            'approver'=> $approver,
        ]);
    }

    public function role_filter(Request $request)
    {
        $data = $request->get('data'); 
       
        $approver = TruApprover::where('title', '=', $data)
        ->get();

        return response()->json([
            'status'=> 200,
            'approver'=> $approver,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $approver = TruApprover::find($id);
        if($approver){
            return response()->json([
                'status'=>200,
                'approver'=>$approver,
            ]);
        } else {
            return response()->json([
                'status'=>400,
                'message'=>'No approver id found!!!'
            ]);
        }
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
