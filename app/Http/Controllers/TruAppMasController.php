<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TruAppMasster;

class TruAppMasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approver = TruAppMasster::all();
        return response()->json([
            'status' => 200,
            'approver' => $approver,
        ]);
    }

    public function dept_filter(Request $request)
    {
        $data = $request->get('data'); 
       
        $approver = TruAppMasster::where('agency', '=', $data)
        ->first();

        return response()->json([
            'status'=> 200,
            'approver'=> $approver,
        ]);
    }
     
    public function role_filter(Request $request)
    {
        $data = $request->get('data'); 
       
        $approver = TruAppMasster::where('dept', '=', $data)
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
